<?php

namespace App\Models;

use CodeIgniter\Model;

class AddonModel extends Model
{
    protected $table = 'tbl_addon';
    protected $primaryKey = 'addon_id';
    protected $returnType = 'object';

    protected $allowedFields = ['addon_id', 'addon_name', 'addon_price', 'addon_number', 'addon_message', 'addon_type', 'addon_status'];
}