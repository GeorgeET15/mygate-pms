<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table      = 'property';
    protected $primaryKey = 'property_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'property_type',
        'property_name',
        'frequency',
        'unit',
        'tarea',
        'tarea_munit',
        'property_address',
        'city',
        'property_country',
        'property_province',
        'zip_code'
    ];

    // Dates
    protected $useTimestamps = false;
    
    // Validation Rules
    protected $validationRules = [
        'property_name' => 'required|min_length[3]',
        'property_type' => 'required',
        'city'          => 'required'
    ];
}
