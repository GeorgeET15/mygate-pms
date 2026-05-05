<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaseModel extends Model
{
    protected $table      = 'p_lease';
    protected $primaryKey = 'leaseId';

    protected $allowedFields = [
        'tenantId',
        'moveinDate',
        'moveoutDate',
        'property_name',
        'frequency',
        'vacant_unit',
        'rentAmount',
        'leaseStatus'
    ];
}
