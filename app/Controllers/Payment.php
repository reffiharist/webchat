<?php

namespace App\Controllers;

class Payment extends BaseController
{
	public function status($status = NULL, $id = NULL)
	{
		$data['page'] = "payment/status";

        return view('frontend', $data);
	}
}