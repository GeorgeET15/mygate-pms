<?php

namespace App\Models;

use CodeIgniter\Model;

class QuickLinkModel extends Model
{
    protected $table      = 'p_quick_links';
    protected $primaryKey = 'link_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'title',
        'url'
    ];

    protected $useTimestamps = false;
}
