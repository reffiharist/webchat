<?php

namespace App\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
    protected $table = 'tbl_feature';
    protected $primaryKey = 'feature_id';
    protected $returnType = 'object';

    protected $allowedFields = ['feature_id', 'feature_name', 'feature_icon', 'feature_desc', 'feature_status'];
}