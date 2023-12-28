<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data['page'] = "home/view";
        $data['pageTitle'] = "Dashboard";
        $data['script'] = [
            script_tag('public/assets/admin/custom/dashboard.js'),
            script_tag('public/assets/admin/js/custom/widgets.js')
        ];

        return view('backend', $data);
    }
}
