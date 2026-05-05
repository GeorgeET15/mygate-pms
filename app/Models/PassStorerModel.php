<?php

namespace App\Models;

use CodeIgniter\Model;

class PassStorerModel extends Model
{
    protected $table      = 'pass_storer';
    protected $primaryKey = 'pass_storer_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'title',
        'url',
        'username',
        'password',
        'description'
    ];

    protected $useTimestamps = false;
}
