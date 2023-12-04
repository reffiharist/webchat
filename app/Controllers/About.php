<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index(): string
    {
        $data['page'] = "about/view";
        
        return view('frontend', $data);
    }
}
