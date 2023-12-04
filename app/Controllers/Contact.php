<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index(): string
    {
        $data['page'] = "contact/view";
        
        return view('frontend', $data);
    }
}
