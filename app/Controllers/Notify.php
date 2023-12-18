<?php

namespace App\Controllers;

class Notify extends BaseController
{
    public function invoicePaid()
    {
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);

        $this->createFile($jsonData, 'invoice');
    }

    public function vaCreate()
    {
        $json = json_decode(file_get_contents("php://input"));
        $this->createFile($jsonData, 'va-create');
    }

    public function vaPaid()
    {
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);

        $this->createFile($jsonData, 'va-paid');
    }

    public function outletPaid()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'outlet');
    }

    public function qrPaid()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'qr');
    }

    public function paylaterStatus()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'paylater');
    }

    public function cardAuth()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'card-auth');
    }

    public function cardToken()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'card-token');
    }

    public function ewalletStatus()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'ewallet');
    }

    // FUNCTION ADDON

    public function createFile($file, $payBy)
    {
        $filePath = 'callback/'.$payBy.'-'.date('YmdHis').'.txt';
        $fileHandle = fopen($filePath, 'w');

        fwrite($fileHandle, $file);
        fclose($fileHandle);
    }
}
