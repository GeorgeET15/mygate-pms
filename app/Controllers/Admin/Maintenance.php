<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MaintenanceModel;
use App\Models\PropertyModel;
use App\Models\UnitModel;

class Maintenance extends BaseController
{
    protected $maintenanceModel;

    public function __construct()
    {
        $this->maintenanceModel = new MaintenanceModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Maintenance Log',
            'logs'  => $this->maintenanceModel
                        ->select('p_maintenance_log.*, property.property_name as prop_name')
                        ->join('property', 'property.property_id = p_maintenance_log.PropertyId', 'left')
                        ->findAll()
        ];

        return view('admin/maintenance/index', $data);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        if ($this->request->is('post')) {
            if ($this->maintenanceModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/maintenance')->with('success', 'Log added.');
            }
        }
        return view('admin/maintenance/create', [
            'title' => 'Add Entry',
            'properties' => $propertyModel->findAll()
        ]);
    }

    public function delete($id = null)
    {
        $this->maintenanceModel->delete($id);
        return redirect()->to('/admin/maintenance')->with('success', 'Deleted.');
    }
}
