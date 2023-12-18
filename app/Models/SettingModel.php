<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'tbl_setting';
    protected $primaryKey = 'setting_id';
    protected $returnType = 'object';

    protected $allowedFields = ['setting_id', 'api_key'];
}