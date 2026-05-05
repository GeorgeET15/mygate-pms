<?php

namespace App\Models;

use CodeIgniter\Model;

class RentFormOtherModel extends Model
{
    protected $table      = 'p_rentformother';
    protected $primaryKey = 'rentform_id';
    protected $allowedFields = ['appinfo_id', 'ref1_name', 'ref1phone', 'ref1relation', 'emrcontactname', 'emr_contactnumber', 'emr_contactrel'];
}
