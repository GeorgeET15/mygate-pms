<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'admin_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Fields that can be updated
    protected $allowedFields = ['name', 'email', 'password', 'level'];

    protected $useTimestamps = false;
}
