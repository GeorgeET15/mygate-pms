<?php

namespace App\Models;

use CodeIgniter\Model;

class RentalHistoryModel extends Model
{
    protected $table      = 'p_rentalhistory';
    protected $primaryKey = 'rhistory_id';
    protected $allowedFields = ['appinfo_id', 'cur_address', 'cur_renamnt', 'curlname', 'cur_resleaving'];
}
