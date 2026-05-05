<?php

namespace App\Models;

use CodeIgniter\Model;

class LandlordModel extends Model
{
    protected $table      = 'p_landlord';
    protected $primaryKey = 'landlord_id';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'contact_no',
        'address',
        'city',
        'country',
        'state',
        'zip_code'
    ];
}
