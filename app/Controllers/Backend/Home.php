<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data['page'] = "home/view";
        $data['pageTitle'] = "Dashboard";

        return view('backend', $data);
    }
}
