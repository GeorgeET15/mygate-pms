<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkOrderModel extends Model
{
    protected $table      = 'work_order';
    protected $primaryKey = 'wo_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'contractor',
        'PropertyId',
        'JobTitle',
        'JobDescription',
        'Material1Cost',
        'Labor1Charge',
        'isWorkDone',
        'Notes'
    ];

    protected $useTimestamps = false;
}
