<?php

namespace App\Controllers;

use App\Models\SettingsModel;

class Settings extends BaseController
{
    public function index()
    {
        $settingsModel = new SettingsModel();
        
        $data = [
            'title'    => 'System Settings',
            'settings' => $settingsModel->getSystemSettings()
        ];

        return view('settings/index', $data);
    }

    public function update()
    {
        // Validation using CI4 methods
        if (!$this->validate([
            'system_name' => 'required|min_length[3]',
            'system_email' => 'required|valid_email'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $settingsModel = new SettingsModel();
        
        // Loop through post data to update settings
        $postData = $this->request->getPost();
        foreach ($postData as $type => $description) {
            // Find existing setting
            $setting = $settingsModel->where('type', $type)->first();
            if ($setting) {
                $settingsModel->update($setting['settings_id'], ['description' => $description]);
            }
        }

        return redirect()->to('/settings')->with('success', 'Settings updated successfully.');
    }
}
