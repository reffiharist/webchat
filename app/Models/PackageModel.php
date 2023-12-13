<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table = 'tbl_package';
    protected $primaryKey = 'package_id';
    protected $returnType = 'object';

    protected $allowedFields = ['package_id', 'package_name', 'package_desc', 'package_price', 'package_type', 'package_status'];
}