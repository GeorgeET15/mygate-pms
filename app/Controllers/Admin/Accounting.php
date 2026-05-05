<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JournalModel;
use App\Models\ReceiptModel;

class Accounting extends BaseController
{
    protected $journalModel;
    protected $receiptModel;

    public function __construct()
    {
        $this->journalModel = new JournalModel();
        $this->receiptModel = new ReceiptModel();
    }

    public function journal()
    {
        $data = [
            'title'           => 'Journal Entries',
            'journal_entries' => $this->journalModel->getJournalWithDetails()
        ];
        
        return view('admin/accounting/journal', $data);
    }

    public function receipts()
    {
        $data = [
            'title'    => 'Receipts',
            'receipts' => $this->receiptModel->orderBy('receipt_date', 'DESC')->findAll()
        ];
        
        return view('admin/accounting/receipts', $data);
    }

    public function vouchers()
    {
        // For now, listing journal entries marked as vouchers or just all journal entries
        $data = [
            'title'    => 'Debit Vouchers',
            'vouchers' => $this->journalModel->findAll()
        ];
        return view('admin/accounting/vouchers', $data);
    }

    public function add_receipt()
    {
        if ($this->request->is('post')) {
            if ($this->receiptModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/accounting/receipts')->with('success', 'Receipt added.');
            }
        }
        return view('admin/accounting/add_receipt', ['title' => 'Add Receipt']);
    }
}
