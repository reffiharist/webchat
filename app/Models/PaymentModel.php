<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tbl_payment';
    protected $primaryKey = 'payment_id';
    protected $returnType = 'object';

    protected $allowedFields = ['payment_id', 'oder_id', 'data_id', 'external_id', 'amount', 'description', 'expiry_date', 'status', 'invoice_url', 'payment_method', 'payment_channel', 'payment_destination', 'fee', 'due_date', 'paid_date'];
}