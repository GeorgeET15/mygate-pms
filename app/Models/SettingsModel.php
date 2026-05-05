<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table      = 'settings';
    protected $primaryKey = 'settings_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Defines which columns can be updated/inserted
    protected $allowedFields = ['type', 'description'];

    // Timestamps
    protected $useTimestamps = false;

    /**
     * Helper method to get all settings as a key-value array
     */
    public function getSystemSettings(): array
    {
        $settings = $this->findAll();
        $formatted = [];
        foreach ($settings as $row) {
            $formatted[$row['type']] = $row['description'];
        }
        return $formatted;
    }
}
