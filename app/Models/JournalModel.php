<?php

namespace App\Models;

use CodeIgniter\Model;

class JournalModel extends Model
{
    protected $table      = 'journal';
    protected $primaryKey = 'journal_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'proj_id',
        'jv_no',
        'jv_date',
        'ledger_id',
        'narration',
        'dr_amt',
        'cr_amt',
        'tr_from',
        'tr_no',
        'receiver_id',
        'cc_code',
        'user_id'
    ];

    // Dates
    protected $useTimestamps = false;

    protected $validationRules = [
        'jv_no'     => 'required|numeric',
        'jv_date'   => 'required',
        'ledger_id' => 'required|numeric',
        'dr_amt'    => 'required|numeric',
        'cr_amt'    => 'required|numeric'
    ];
    public function getJournalWithDetails()
    {
        return $this->select('journal.*, accounts_ledger.ledger_name as account_name')
                    ->join('accounts_ledger', 'accounts_ledger.ledger_id = journal.ledger_id', 'left')
                    ->orderBy('journal.jv_date', 'DESC')
                    ->findAll();
    }
}
