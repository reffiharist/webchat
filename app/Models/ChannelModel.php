<?php

namespace App\Models;

use CodeIgniter\Model;

class ChannelModel extends Model
{
    protected $table = 'tbl_channel';
    protected $primaryKey = 'channel_id';
    protected $returnType = 'object';

    protected $allowedFields = ['channel_id', 'channel_code', 'channel_name', 'channel_fee', 'channel_feeadd', 'channel_fee_type', 'channel_feeadd_type', 'channel_image', 'channel_category', 'channel_seq', 'channel_status'];
}