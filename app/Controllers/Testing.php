<?php

namespace App\Controllers;

class Testing extends BaseController
{
    public function index()
    {
        for ($i = 1; $i <= 5; $i++)
        { 
        	echo date('h:i:s')."<br>";
        	sleep(2);
        }
    }
}