<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\OrderModel;

class Notify extends BaseController
{

    // INVOICE

    public function invoicePaid()
    {
        $jsonData = file_get_contents("php://input");
        $json = json_decode($jsonData);

        $this->createFile($jsonData, 'invoice');

        // Process paid
        $paymentModel = new PaymentModel;
        $orderModel = new OrderModel;

        $payment = $paymentModel->where('external_id', $json->external_id)->first();
        $orers = $orderModel->find($payment->order_id);
        $status = strtolower($json->status);

        if($status == 'paid')
        {
            $data['status'] = $status;
            $data['payment_method'] = !empty($json->payment_method) ? $json->payment_method : "";
            $data['payment_channel'] = !empty($json->payment_channel) ? $json->payment_channel : "";
            $data['paid_date'] = dateTimeZoneToDatetime($json->paid_at, FALSE);
            $data['payment_destination'] = !empty($json->payment_destination) ? $json->payment_destination : "";

            $paymentModel->update($payment->payment_id, $data);
            $orderModel->update($orders->order_id, ['order_status' => 'paid']);

            // Send email to customer
        }
        else if($status == 'expired')
        {
            $paymentModel->update($payment->payment_id, ['payment_status' => $status]);
            $orderModel->update($orders->order_id, ['order_status' => 'canceled']);
        }
        else
        {
            $paymentModel->update($payment->payment_id, ['payment_status' => $status]);
        }
    }


    // VIRTUAL ACCOUNT

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


    // OUTLET ALFAMART / INDOMARET

    public function outletPaid()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'outlet');
    }


    // QRCODE

    public function qrPaid()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'qr');
    }


    // PAYLATER

    public function paylaterStatus()
    {
        $json = file_get_contents("php://input");

        $this->createFile($json, 'paylater');
    }


    // CREDIT CARD

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


    // EWAKKET

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

    private function sendMail($paymentId = NULL, $orderId = NULL)
    {
        if($invoiceId == NULL || $transId == NULL) {
            return FALSE;
        }

        $paymentModel = new PaymentModel;
        $orderModel = new OrderModel;

        $payment = $paymentModel->find($paymentId);
        $order = $orderModel->find($orderId);

        $datamail['payment'] = $payment;
        $datamail['order'] = $order;

        $to = $post['email'];
        $subject = 'Payment Success - Webchat.com';
        $message = view('email/payment_success', $datamail);

        sendEmail($to, $subject, $message);
    }
}
