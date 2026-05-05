<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TenantModel;
use App\Models\PropertyModel;
use App\Models\UnitModel;

class Tenant extends BaseController
{
    protected $tenantModel;

    public function __construct()
    {
        $this->tenantModel = new TenantModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manage Tenants',
            'tenants' => $this->tenantModel->getTenantsWithDetails()
        ];
        
        return view('admin/tenant/index', $data);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        $unitModel     = new UnitModel();

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->tenantModel->insert($postData)) {
                return redirect()->to('/admin/tenant')->with('success', 'Tenant added successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->tenantModel->errors());
        }

        return view('admin/tenant/create', [
            'title'      => 'Add Tenant',
            'properties' => $propertyModel->findAll(),
            'units'      => $unitModel->findAll()
        ]);
    }

    public function edit($id = null)
    {
        $tenant = $this->tenantModel->find($id);
        if (!$tenant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $propertyModel = new PropertyModel();
        $unitModel     = new UnitModel();

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->tenantModel->update($id, $postData)) {
                return redirect()->to('/admin/tenant')->with('success', 'Tenant updated successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->tenantModel->errors());
        }

        return view('admin/tenant/edit', [
            'title'      => 'Edit Tenant',
            'tenant'     => $tenant,
            'properties' => $propertyModel->findAll(),
            'units'      => $unitModel->findAll()
        ]);
    }

    public function delete($id = null)
    {
        if ($this->tenantModel->delete($id)) {
            return redirect()->to('/admin/tenant')->with('success', 'Tenant deleted successfully.');
        }
        return redirect()->to('/admin/tenant')->with('error', 'Unable to delete tenant.');
    }
}
