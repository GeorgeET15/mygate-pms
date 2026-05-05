<?php

namespace App\Models;

use CodeIgniter\Model;

class GivingAnswerModel extends Model
{
    protected $table      = 'p_givinganswer';
    protected $primaryKey = 'givingans_id';
    protected $allowedFields = ['appinfo_id', 'dec_bankrupcy', 'evicted_residence', 'con_felony', 'parole'];
}
