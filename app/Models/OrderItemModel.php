<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'tbl_order_item';
    protected $primaryKey = 'item_id';
    protected $returnType = 'object';
    protected $allowedFields = ['item_id', 'order_id', 'product_id', 'item_price', 'item_qty', 'item_total', 'is_addon'];
}