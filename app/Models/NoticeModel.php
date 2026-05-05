<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticeModel extends Model
{
    protected $table      = 'noticeboard';
    protected $primaryKey = 'notice_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'notice_title',
        'notice',
        'create_timestamp'
    ];

    protected $useTimestamps = false; // Legacy uses create_timestamp as a raw field usually
}
