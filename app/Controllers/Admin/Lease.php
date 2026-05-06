<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LeaseModel;
use App\Models\TenantModel;
use App\Models\PropertyModel;
use App\Models\UnitModel;

class Lease extends BaseController
{
    protected $leaseModel;

    public function __construct()
    {
        $this->leaseModel = new LeaseModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Lease Agreements',
            'leases' => $this->leaseModel
                        ->select('p_lease.*, p_tenant.tenant_name, property.property_name, unit.unit_name')
                        ->join('p_tenant', 'p_tenant.tenant_id = p_lease.tenantId', 'left')
                        ->join('property', 'property.property_id = p_lease.property_name', 'left')
                        ->join('unit', 'unit.unit_id = p_lease.vacant_unit', 'left')
                        ->findAll()
        ];

        return view('admin/lease/index', $data);
    }

    public function weekly()
    {
        $data = [
            'title'  => 'Weekly Lease Agreements',
            'leases' => $this->leaseModel
                        ->select('p_lease.*, p_tenant.tenant_name, property.property_name, unit.unit_name')
                        ->join('p_tenant', 'p_tenant.tenant_id = p_lease.tenantId', 'left')
                        ->join('property', 'property.property_id = p_lease.property_name', 'left')
                        ->join('unit', 'unit.unit_id = p_lease.vacant_unit', 'left')
                        ->where('p_lease.frequency', 'Weekly')
                        ->findAll()
        ];

        return view('admin/lease/index', $data);
    }

    public function view($id = null)
    {
        $lease = $this->leaseModel
                      ->select('p_lease.*, p_tenant.tenant_name, property.property_name, unit.unit_name')
                      ->join('p_tenant', 'p_tenant.tenant_id = p_lease.tenantId', 'left')
                      ->join('property', 'property.property_id = p_lease.property_name', 'left')
                      ->join('unit', 'unit.unit_id = p_lease.vacant_unit', 'left')
                      ->find($id);

        if (!$lease) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('admin/lease/view', [
            'title' => 'View Lease',
            'lease' => $lease
        ]);
    }

    public function edit($id = null)
    {
        $propertyModel = new PropertyModel();
        $unitModel = new UnitModel();
        $tenantModel = new TenantModel();

        if ($this->request->is('post')) {
            if ($this->leaseModel->update($id, $this->request->getPost())) {
                return redirect()->to('/admin/lease')->with('success', 'Lease updated.');
            }
        }

        $lease = $this->leaseModel->find($id);
        if (!$lease) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('admin/lease/edit', [
            'title'      => 'Edit Lease',
            'lease'      => $lease,
            'properties' => $propertyModel->findAll(),
            'units'      => $unitModel->where('property_name', $lease['property_name'])->findAll(),
            'tenants'    => $tenantModel->findAll()
        ]);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        if ($this->request->is('post')) {
            if ($this->leaseModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/lease')->with('success', 'Lease created.');
            }
        }
        return view('admin/lease/create', [
            'title'      => 'Create Lease',
            'properties' => $propertyModel->findAll()
        ]);
    }

    public function delete($id = null)
    {
        $this->leaseModel->delete($id);
        return redirect()->to('/admin/lease')->with('success', 'Deleted.');
    }

    public function renew($id = null)
    {
        // ... same logic as before
        return view('admin/lease/renew', ['title' => 'Renew Lease', 'lease' => $this->leaseModel->find($id)]);
    }

    public function terminate($id = null)
    {
        // ... same logic as before
        return view('admin/lease/terminate', ['title' => 'Terminate Lease', 'lease_id' => $id]);
    }
}
