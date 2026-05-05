<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'p_project';
    protected $primaryKey = 'project_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'project_name',
        'project_description'
    ];

    protected $useTimestamps = false;
}
