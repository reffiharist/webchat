<?php

namespace App\Libraries;

class Enum {

	public function adminType() {

		$data['admin'] = "Administrator";
		$data['user'] = "User";

		return $data;
	}

	public function packageType() {

		$data['personal'] = "Personal";
		$data['company'] = "Company";

		return $data;
	}

	public function packageDuration() {

		$data[1] = "1 Bulan";
		$data[6] = "6 Bulan";
		$data[12] = "1 Tahun";
		$data[24] = "2 Tahun";

		return $data;
	}

	public function paymentMethod()
    {
        $data['credit_card'] = "Credit Card";
        $data['bank_transfer'] = "Bank Transfer";
        $data['direct_debit'] = "Direct Debit";
        $data['retail_outlet'] = "Retail Outlet";
        $data['paylater'] = "Paylater";
        $data['ewallet'] = "E Wallet";
        $data['qr'] = "QR";

        return $data;
    }
}