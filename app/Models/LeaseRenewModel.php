<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaseRenewModel extends Model
{
    protected $table      = 'p_lease_renew';
    protected $primaryKey = 'lease_renew_id';
    protected $allowedFields = ['moveinDate', 'moveoutDate', 'leaseId', 'renewalDate'];
}
