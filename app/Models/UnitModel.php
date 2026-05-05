<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table      = 'unit';
    protected $primaryKey = 'unit_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'unit_name',
        'unit_type',
        'property_name', // actually property_id FK
        'floor_number',
        'bedrooms',
        'bathrooms',
        'trent',
        'trent_period',
        'vacant_status'
    ];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'unit_name'     => 'required',
        'property_name' => 'required|numeric',
        'trent'         => 'required|numeric'
    ];

    /**
     * Get units along with their associated property details
     */
    public function getUnitsWithProperty()
    {
        return $this->select('unit.*, property.property_name as prop_name')
                    ->join('property', 'property.property_id = unit.property_name', 'left')
                    ->findAll();
    }
}
