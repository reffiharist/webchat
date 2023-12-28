<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'tbl_faq';
    protected $primaryKey = 'faq_id';
    protected $returnType = 'object';

    protected $allowedFields = ['faq_id', 'question', 'answer', 'faq_status'];
}