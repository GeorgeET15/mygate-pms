<?php

namespace App\Models;

use CodeIgniter\Model;

class TerminationModel extends Model
{
    protected $table      = 'p_termination';
    protected $primaryKey = 'termination_id';
    protected $allowedFields = ['leavingDate', 'leavingReason', 'leaseId'];
}
