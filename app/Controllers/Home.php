<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['page'] = "home/view";
        
        return view('frontend', $data);
    }
}
