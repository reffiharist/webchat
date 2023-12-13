<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\AddonModel;
use App\Models\ChannelModel;

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

    public function getFee()
    {
        $post = $this->request->getPost(['channel', 'price']);

        if(!isset($post['channel'])) {
            echo json_encode(['error' => true, 'message' => 'Please select payment channel']);
        }

        if(!isset($post['price'])) {
            echo json_encode(['error' => true, 'message' => 'Please select package']);
        }

        $channelModel = new ChannelModel;
        $channelId = decrypt($post['channel']);
        $price = $post['price'];

        $data = $channelModel->find($channelId);

        $fee = $data->channel_fee_type == 'nominal' ? $data->channel_fee : $data->channel_fee * $price;
        $feeadd = $data->channel_feeadd_type == 'nominal' ? $data->channel_feeadd : $data->channel_feeadd * $price;

        $totalFee = $fee + $feeadd;

        echo json_encode(['error' => false, 'fee' => $totalFee]);
    }

    public function processOrder()
    {
        $post = $this->request->getPost(['channel', 'price']);
    }
}
