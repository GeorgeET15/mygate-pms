<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;
use App\Models\TenantModel;
use App\Models\UnitModel;
use App\Models\InvoiceModel;
use App\Models\MaintenanceModel;
use App\Models\ApplicationInfoModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $propertyModel    = new PropertyModel();
        $tenantModel      = new TenantModel();
        $unitModel        = new UnitModel();
        $invoiceModel     = new InvoiceModel();
        $maintenanceModel = new MaintenanceModel();
        $appModel         = new ApplicationInfoModel();

        $data = [
            'title'             => 'Dashboard',
            'total_properties'  => $propertyModel->countAllResults(),
            'total_tenants'     => $tenantModel->countAllResults(),
            'total_units'       => $unitModel->countAllResults(),
            'vacant_units'      => $unitModel->where('vacant_status', 0)->countAllResults(),
            'total_revenue'     => $invoiceModel->selectSum('TotalPrice')->first()['TotalPrice'] ?? 0,
            'recent_invoices'   => $invoiceModel->getInvoicesWithDetails(),
            'recent_maintenance'=> $maintenanceModel->orderBy('when_done', 'DESC')->limit(5)->find(),
            'pending_apps'      => $appModel->where('rent_status', 0)->countAllResults()
        ];

        return view('admin/dashboard/index', $data);
    }
}
