<?php

namespace App\Libraries;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

// use App\Model\SettingModel;

class Xpayment
{
	private $apiKey;

	function __construct()
	{
		$model = model('SettingModel');
        $data = $model->find(1);

		$this->apiKey = $data->is_production ? $data->api_key : $data->api_key_test;

		Configuration::setXenditKey($this->apiKey);
    }

	// VIRTUAL ACCOUNT

	function virtualAccountBank()
	{
		$getVABanks = \Xendit\VirtualAccounts::getVABanks();

		$filteredArray = [];

		foreach ($getVABanks as $bank) {

			if($bank['country'] == 'ID' && $bank['is_activated'] == 1 && $bank['currency'] == 'IDR') {
				$filteredArray[] = $bank;
			}
		}

		return $filteredArray;
	}

	function createVirtualAccount($data = [])
	{
		$params = [ 
			"external_id" => $data['external_id'],
			"bank_code" => $data['bank_code'],
			"name" => $data['name'],
			"is_closed" => true,
			"expected_amount" => $data['amount'],
			"expiration_date" => getDateWithTimeZone()
		];

		$createVA = \Xendit\VirtualAccounts::create($params);

		return $createVA;
	}

	function getVirtualAccount($id)
	{
		$getVA = \Xendit\VirtualAccounts::retrieve($id);
		
		return $getVA;
	}


	// INVOICE

	function createInvoice($data = [])
	{
		$for_user_id = "656842102dfa4c4226febb46";

		$params = [ 
		    'external_id' => $data['external_id'],
		    'amount' => $data['amount'],
		    'description' => $data['description'],
		    'invoice_duration' => 86400,
		    'customer' => [
		        'given_names' => $data['customer']['name'],
		        'email' => $data['customer']['email'],
		        'mobile_number' => $data['customer']['mobile_number']
		    ],
		    'success_redirect_url' => site_url('payment/status/'.$data['external_id'].'/success'),
		    'failure_redirect_url' => site_url('payment/status/'.$data['external_id'].'/failed'),
		    'payment_methods' => [$data['payment_methods']],
		    'currency' => 'IDR',
		    'items' => $data['items'],
		    'fees' => [
		        [
		            'type' => 'ADMIN',
		            'value' => (int)$data['fee']
		        ]
		    ]
		];

		$apiInstance = new InvoiceApi();
		$create_invoice_request = new CreateInvoiceRequest($params);
		$result = $apiInstance->createInvoice($create_invoice_request);
		  
		return $result;
	}
}