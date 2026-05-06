<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;
use App\Models\TenantModel;
use App\Models\UnitModel;
use App\Models\InvoiceModel;
use App\Models\MaintenanceModel;
use App\Models\ApplicationInfoModel;
use App\Models\SettingModel;
use App\Models\LandlordModel;
use App\Models\MarketingModel;
use App\Models\NoticeModel;
use App\Models\ProjectModel;
use App\Models\QuickLinkModel;

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
        $settingModel     = new SettingModel();
        $landlordModel    = new LandlordModel();
        $marketingModel   = new MarketingModel();
        $noticeModel      = new NoticeModel();
        $projectModel     = new ProjectModel();
        $linkModel        = new QuickLinkModel();

        // Fetch dashboard preferences
        $prefs = $settingModel->where('type LIKE', 'dash_%')->findAll();
        $dash_settings = [];
        foreach ($prefs as $p) {
            $dash_settings[$p['type']] = $p['description'];
        }

        $data = [
            'title'             => 'Dashboard',
            'total_properties'  => $propertyModel->countAllResults(),
            'total_tenants'     => $tenantModel->countAllResults(),
            'total_units'       => $unitModel->countAllResults(),
            'vacant_units'      => $unitModel->where('vacant_status', 1)->countAllResults(),
            'total_revenue'     => $invoiceModel->selectSum('TotalPrice')->first()['TotalPrice'] ?? 0,
            'recent_invoices'   => $invoiceModel->getInvoicesWithDetails(),
            'recent_maintenance'=> $maintenanceModel->orderBy('when_done', 'DESC')->find(),
            'pending_apps'      => $appModel->where('rent_status', 0)->countAllResults(),
            'dash_settings'     => $dash_settings,
            'recent_landlords'  => $landlordModel->orderBy('landlord_id', 'DESC')->limit(5)->find(),
            'recent_marketing'  => $marketingModel->orderBy('marketing_id', 'DESC')->limit(5)->find(),
            'recent_notices'    => $noticeModel->orderBy('notice_id', 'DESC')->limit(5)->find(),
            'recent_projects'   => $projectModel->orderBy('project_id', 'DESC')->limit(5)->find(),
            'recent_links'      => $linkModel->orderBy('id', 'DESC')->limit(5)->find(),
        ];

        return view('admin/dashboard/index', $data);
    }
}
