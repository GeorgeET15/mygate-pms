<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceiptModel extends Model
{
    protected $table      = 'receipt';
    protected $primaryKey = 'receipt_id';

    protected $allowedFields = [
        'receipt_no',
        'receipt_date',
        'narration',
        'ledger_id',
        'dr_amt',
        'cr_amt',
        'received_from'
    ];
}
