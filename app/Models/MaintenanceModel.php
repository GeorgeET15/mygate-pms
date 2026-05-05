<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table      = 'p_maintenance_log';
    protected $primaryKey = 'maintenance_log_id';
    protected $allowedFields = ['contractor', 'PropertyId', 'UnitName', 'Category', 'MaintenanceTitle', 'Description', 'when_done', 'Notes', 'user'];
}
