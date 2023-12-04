<?php

namespace App\Controllers;

class Pricing extends BaseController
{
    public function index(): string
    {
        $data['page'] = "pricing/view";
        
        return view('frontend', $data);
    }
}
