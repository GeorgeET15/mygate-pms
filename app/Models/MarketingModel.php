<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketingModel extends Model
{
    protected $table      = 'p_marketing';
    protected $primaryKey = 'marketing_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'marketingName',
        'postingTitle',
        'description',
        'shortDescription',
        'propertyName',
        'vacantUnit',
        'availableDate',
        'status'
    ];

    protected $useTimestamps = false;
}
