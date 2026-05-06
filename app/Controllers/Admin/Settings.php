<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LateFeeModel;
use App\Models\SettingModel;
use App\Models\PassStorerModel;

class Settings extends BaseController
{
    public function late_fee()
    {
        $model = new LateFeeModel();
        if ($this->request->is('post')) {
            if ($model->update(1, $this->request->getPost())) {
                return redirect()->to('/admin/settings/late_fee')->with('success', 'Late fee settings updated.');
            }
        }
        $data = [
            'title'    => 'Late Fee Settings',
            'settings' => $model->find(1)
        ];
        return view('admin/settings/late_fee', $data);
    }

    public function dashboard()
    {
        $model = new SettingModel();
        if ($this->request->is('post')) {
            $data = $this->request->getPost('dash');
            foreach ($data as $type => $value) {
                $model->where('type', $type)->set(['description' => $value])->update();
            }
            // Also handle checkboxes that are unchecked (won't be in POST)
            $all_types = [
                'dash_show_properties', 'dash_show_vacant', 'dash_show_revenue', 'dash_show_pending', 
                'dash_show_chart', 'dash_show_maintenance', 'dash_show_tenants', 'dash_show_marketing',
                'dash_show_links', 'dash_show_notices', 'dash_show_projects', 'dash_show_landlords'
            ];
            foreach ($all_types as $type) {
                if (!isset($data[$type])) {
                    $model->where('type', $type)->set(['description' => '0'])->update();
                }
            }
            return redirect()->to('/admin/settings/dashboard')->with('success', 'Dashboard preferences updated.');
        }
        
        $settings = $model->where('type LIKE', 'dash_%')->findAll();
        $formatted = [];
        foreach ($settings as $s) {
            $formatted[$s['type']] = $s['description'];
        }

        return view('admin/settings/dashboard', [
            'title'    => 'Dashboard Preferences',
            'settings' => $formatted
        ]);
    }

    public function system()
    {
        $model = new SettingModel();
        if ($this->request->is('post')) {
            $data = $this->request->getPost();
            foreach ($data as $type => $description) {
                $model->where('type', $type)->set(['description' => $description])->update();
            }
            return redirect()->to('/admin/settings/system')->with('success', 'System settings updated.');
        }
        $data = [
            'title'    => 'System Settings',
            'settings' => $model->where('type NOT LIKE', 'dash_%')->findAll()
        ];
        return view('admin/settings/system', $data);
    }

    public function pass_storer()
    {
        $model = new PassStorerModel();
        $data = [
            'title'   => 'Pass Storer',
            'entries' => $model->findAll()
        ];
        return view('admin/settings/pass_storer', $data);
    }

    public function create_pass()
    {
        $model = new PassStorerModel();
        if ($this->request->is('post')) {
            if ($model->insert($this->request->getPost())) {
                return redirect()->to('/admin/settings/pass_storer')->with('success', 'Entry added.');
            }
        }
        return view('admin/settings/create_pass', ['title' => 'Add Entry']);
    }

    public function delete_pass($id = null)
    {
        $model = new PassStorerModel();
        $model->delete($id);
        return redirect()->to('/admin/settings/pass_storer')->with('success', 'Entry deleted.');
    }
}
