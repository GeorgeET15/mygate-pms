<?php

namespace App\Models;

use CodeIgniter\Model;

class LateFeeModel extends Model
{
    protected $table      = 'p_late_fee_setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fee_frequency', 'fee_amount', 'fee_ratio'];
}
