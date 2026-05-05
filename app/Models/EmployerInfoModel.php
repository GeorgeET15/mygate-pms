<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployerInfoModel extends Model
{
    protected $table      = 'p_empinfo';
    protected $primaryKey = 'emp_id';
    protected $allowedFields = ['appinfo_id', 'emp_name', 'job_type', 'emp_address', 'position', 'monthly_income'];
}
