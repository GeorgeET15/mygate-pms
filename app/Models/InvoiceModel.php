<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table      = 'p_tenant_bill';
    protected $primaryKey = 'tenant_bill_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'InvId',
        'PropertyId',
        'TenantId',
        'LeaseId',
        'UnitId',
        'Attention',
        'PaymentHeadId',
        'RefNo',
        'moveinDate',
        'EnteredBy',
        'Entrydate',
        'TotalPrice',
        'BalanceAmount',
        'invStatus'
    ];

    // Dates
    protected $useTimestamps = false;

    protected $validationRules = [
        'InvId'      => 'required',
        'PropertyId' => 'required|numeric',
        'TenantId'   => 'required|numeric',
        'TotalPrice' => 'required|numeric'
    ];

    /**
     * Retrieve invoices linked with tenant and property info
     */
    public function getInvoicesWithDetails()
    {
        return $this->select('p_tenant_bill.*, p_tenant.tenant_name, property.property_name')
                    ->join('p_tenant', 'p_tenant.tenant_id = p_tenant_bill.TenantId', 'left')
                    ->join('property', 'property.property_id = p_tenant_bill.PropertyId', 'left')
                    ->findAll();
    }
}
