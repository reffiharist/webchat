<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\AddonModel;
use App\Models\ChannelModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;

use App\Libraries\Xpayment;

class Order extends BaseController
{
    public function index(): string {
        return redirect()->to(site_url());
    }

    public function package($packageId = NULL)
    {
        if(!$packageId) {
            return redirect()->to(site_url());
        }

        $packageModel = new PackageModel;
        $addonModel = new AddonModel;
        $channelModel = new ChannelModel;

        $packageId = decrypt($packageId);
        $package = $packageModel->find($packageId);

        if(!$package) {
            return redirect()->to(site_url());
        }

        $data['page'] = "order/view";
        $data['data'] = $package;
        $data['addon'] = $addonModel->where(['addon_status' => 1, 'addon_type' => $package->package_type])->findAll();
        $data['desc'] = explode(',', $package->package_desc);
        $data['method'] = $this->enum->paymentMethod();
        $data['duration'] = $this->enum->packageDuration();
        $data['channel'] = $channelModel->where('channel_status', 1)->findAll();

        return view('frontend', $data);
    }

    public function getChannel()
    {
        $post = $this->request->getPost(['payMethod']);

        if(!isset($post['payMethod'])) {
            echo json_encode(['error' => true]);
        }

        $channelModel = new ChannelModel;
        $paymentMethod = decrypt($post['payMethod']);
        $channel = $channelModel->where('channel_category', $paymentMethod)->findAll();
        $list = "<option value=''>Select Channel</option>";

        foreach ($channel as $d) {
            $list .= "<option value='".encrypt($d->channel_id)."'>".$d->channel_name."</option>";
        }

        echo json_encode(['error' => false, 'list' => $list]);
    }

    private function getPaymentFee($channelId = NULL, $subtotal = NULL)
    {
        $channelModel = new ChannelModel;
        $data = $channelModel->find($channelId);

        $fee = $data->channel_fee_type == 'nominal' ? $data->channel_fee : $data->channel_fee * $subtotal;
        $feeadd = $data->channel_feeadd_type == 'nominal' ? $data->channel_feeadd : $data->channel_feeadd * $subtotal;

        $totalFee = $fee + $feeadd;

        return $totalFee;
    }

    public function getFee()
    {
        $post = $this->request->getPost(['channel', 'price']);

        if(!isset($post['channel'])) {
            echo json_encode(['error' => true, 'message' => 'Please select payment channel']);
        }

        if(!isset($post['price'])) {
            echo json_encode(['error' => true, 'message' => 'Please select package']);
        }

        $channelId = decrypt($post['channel']);
        $price = $post['price'];
        $totalFee = $this->getPaymentFee($channelId, $price);

        echo json_encode(['error' => false, 'fee' => $totalFee]);
    }

    public function processOrder()
    {
        $post = $this->request->getPost(['package', 'addon', 'durasi', 'payment_channel', 'name', 'telp', 'email']);

        $packageModel = new PackageModel;
        $addonModel = new AddonModel;
        $orderModel = new OrderModel;
        $orderItemModel = new OrderItemModel;
        $channelModel = new ChannelModel;

        $rules = [
            'package' => 'required',
            'durasi' => 'required',
            'payment_channel' => 'required',
        ];

        if(!$this->validate($rules)) {
            $json = [
                'error' => true,
                'package' => $this->validator->showError('name', 'errorSingle'),
                'durasi' => $this->validator->showError('price', 'errorSingle'),
                'payment_channel' => $this->validator->showError('number', 'errorSingle'),
            ];

            echo json_encode($json);
            exit();
        }

        $orderNumber = date("Ym").random_string('numeric', 7);
        $packageId = decrypt($post['package']);
        $durasi = decrypt($post['durasi']);
        $channelId = decrypt($post['payment_channel']);
        $channel = $channelModel->find($channelId);
        $package = $packageModel->find($packageId);
        $packagePrice = $package->package_price * $durasi;
        $addonId = 0;
        $addonPrice = 0;

        if(isset($post['addon'])) {
            $addonId = decrypt($post['addon']);
            $addon = $addonModel->find($addonId);
            $addonPrice = $addon->addon_price;
        }

        $subtotal = $packagePrice + $addonPrice;
        $fee = $this->getPaymentFee($channelId, $subtotal);
        $total = $subtotal + $fee;

        // Insert Order
        $data['order_code'] = $orderNumber;
        $data['order_name'] = $post['name'];
        $data['order_telp'] = $post['telp'];
        $data['order_email'] = $post['email'];
        $data['order_subtotal'] = $subtotal;
        $data['order_fee'] = $fee;
        $data['order_total'] = $total;

        $orderModel->insert($data);
        $orderId = $orderModel->insertID();

        // Insert order item
        $item['order_id'] = $orderId;
        $item['product_id'] = $packageId;
        $item['item_price'] = $package->package_price;
        $item['item_qty'] = $durasi;
        $item['item_total'] = $packagePrice;

        $orderItemModel->insert($item);

        // Insert order item as addon
        if(isset($post['addon']))
        {
            $aon['order_id'] = $orderId;
            $aon['product_id'] = $addonId;
            $aon['item_price'] = $addonPrice;
            $aon['item_qty'] = 1;
            $aon['item_total'] = $addonPrice;
            $aon['is_addon'] = 1;

            $orderItemModel->insert($aon);
        }

        // Create item for payment
        $items = $orderItemModel->where('order_id', $orderId)->findAll();
        $itemList = [];
        $itemListData = [];

        foreach ($items as $d) {
            $itemList[$d->item_id]['name'] = packageName($d->product_id, $d->is_addon); 
            $itemList[$d->item_id]['quantity'] = (int)$d->item_qty; 
            $itemList[$d->item_id]['price'] = (int)$d->item_price; 
        }

        foreach ($itemList as $d) {
            $itemListData[] = $d;
        }

        // Create payment
        $params = [
            'orderId' => $orderId,
            'orderNumber' => $orderNumber,
            'total' => $total,
            'fee' => $fee,
            'customer' => [
                'name' => $post['name'],
                'email' => $post['email'],
                'mobile_number' => '+' . $post['telp'],
            ],
            'channel' => $channel->channel_code,
            'items' => $itemListData,
        ];

        $payment = $this->createPayment($params);

        echo json_encode(['error' => false, 'url' => $payment]);
    }

    private function createPayment($data = [])
    {
        $xpayment = new Xpayment;
        $paymentModel = new PaymentModel;

        // Xendit create invoice
        $params['external_id'] = $data['orderNumber'];
        $params['amount'] = (int)$data['total'];
        $params['description'] = "Invoice #".$data['orderNumber'];
        $params['customer'] = $data['customer'];
        $params['payment_methods'] = $data['channel'];
        $params['items'] = $data['items'];
        $params['fee'] = $data['fee'];

        $xpay = $xpayment->createInvoice($params);

        // Insert into table payment
        $pay['order_id'] = $data['orderId'];
        $pay['data_id'] = $xpay['id'];
        $pay['external_id'] = $xpay['external_id'];
        $pay['amount'] = $xpay['amount'];
        $pay['description'] = $xpay['description'];
        $pay['expiry_date'] = dateTimeZoneToDatetime($xpay['expiry_date']);
        $pay['status'] = $xpay['status'];
        $pay['invoice_url'] = $xpay['invoice_url'];
        $pay['payment_channel'] = $data['channel'];
        $pay['fee'] = $data['fee'];

        $paymentModel->insert($pay);

        return $xpay['invoice_url'];
    }
  
}
