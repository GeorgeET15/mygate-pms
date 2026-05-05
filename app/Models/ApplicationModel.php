<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table      = 'p_appinfo';
    protected $primaryKey = 'appinfo_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'property_name', // FK
        'movein_date',
        'no_of_bedroom',
        'full_name',
        'phone_number',
        'email',
        'ssn',
        'dob',
        'drivinglicense',
        'drivinglicensestate',
        'rent_status',
        'application_date'
    ];

    // Dates
    protected $useTimestamps = false;

    protected $validationRules = [
        'full_name'     => 'required',
        'email'         => 'required|valid_email',
        'property_name' => 'required|numeric'
    ];
}
