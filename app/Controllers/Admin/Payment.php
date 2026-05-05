<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;

class Payment extends BaseController
{
    public function index()
    {
        $invoiceModel = new InvoiceModel();
        $data = [
            'title'    => 'Payment View',
            'payments' => $invoiceModel->getInvoicesWithDetails()
        ];
        return view('admin/payment/index', $data);
    }
}
