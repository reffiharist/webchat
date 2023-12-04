<?php

namespace App\Libraries;

class Enum {

	public function adminType() {

		$data['admin'] = "Administrator";
		$data['user'] = "User";

		return $data;
	}
}