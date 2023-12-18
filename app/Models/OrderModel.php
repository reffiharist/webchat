<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $returnType = 'object';
    protected $allowedFields = ['order_id', 'order_code', 'order_name', 'order_telp', 'order_email', 'order_total', 'order_status'];
}