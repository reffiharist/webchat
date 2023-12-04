<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    protected $returnType = 'object';

    protected $allowedFields = ['user_id', 'user_name', 'user_email', 'user_password', 'user_level', 'is_forgot_password', 'user_active'];
}