<?php

namespace App\Models;

use CodeIgniter\Model;

class QuickLinkModel extends Model
{
    protected $table      = 'p_quick_links';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'website_title',
        'quick_links'
    ];

    protected $useTimestamps = false;
}
