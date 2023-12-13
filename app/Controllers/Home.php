<?php

namespace App\Controllers;

use App\Models\FeatureModel;
use App\Models\PackageModel;
use App\Models\AddonModel;

class Home extends BaseController
{
    public function index(): string
    {
        $featureModel = new FeatureModel;
        $packageModel = new PackageModel;
        $addonModel = new AddonModel;

        $data['page'] = "home/view";
        $data['feature'] = $featureModel->where('feature_status', 1)->findAll();
        $data['price'] = [];

        $packageType = $this->enum->packageType();

        foreach ($packageType as $key => $value) {
            $data['price'][$key] = [ 
                'price' => ['key' => $key, 'value' => $value],
                'package' => $packageModel->where(['package_status' => 1, 'package_type' => $key])->findAll(),
                'addon' => $addonModel->where(['addon_status' => 1, 'addon_type' => $key])->findAll(),
            ];
        }
        
        return view('frontend', $data);
    }
}
