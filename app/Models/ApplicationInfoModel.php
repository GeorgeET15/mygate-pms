<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationInfoModel extends Model
{
    protected $table      = 'p_appinfo';
    protected $primaryKey = 'appinfo_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'property_name',
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

    protected $useTimestamps = false;
}
