<?php

namespace App\Models;

use CodeIgniter\Model;

class TenantModel extends Model
{
    protected $table      = 'p_tenant';
    protected $primaryKey = 'tenant_id';

    protected $allowedFields = [
        'appinfo_id',
        'tenant_name',
        'tenant_contact',
        'property_name',
        'frequency',
        'vacant_unit',
        'tenantStatus'
    ];

    public function getTenantsWithDetails()
    {
        return $this->select('p_tenant.*, property.property_name as prop_name, unit.unit_name')
                    ->join('property', 'property.property_id = p_tenant.property_name', 'left')
                    ->join('unit', 'unit.unit_id = p_tenant.vacant_unit', 'left')
                    ->findAll();
    }
}
