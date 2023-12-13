<?php

use Xendit\Xendit;

class Xpayment
{
	private $apiKey;

	function __construct()
	{
		$_this =& get_instance();

		$_this->load->model(['sys_model']);

		$sys = $_this->sys_model->get(1);

		$this->apiKey = $sys->is_production ? $sys->api_key : $sys->api_key_test;

		Xendit::setApiKey($this->apiKey);
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
		    'success_redirect_url' => site_url('booking/status/'.$data['external_id'].'/success'),
		    'failure_redirect_url' => site_url('booking/status/'.$data['external_id'].'/failed'),
		    'payment_methods' => [$data['payment_methods']],
		    'currency' => 'IDR',
		    'items' => $data['items'],
		    'fees' => [
		        [
		            'type' => 'ADMIN',
		            'value' =>  $data['fee']
		        ]
		    ]
		];

		$createInvoice = \Xendit\Invoice::create($params);
		  
		return $createInvoice;
	}
}