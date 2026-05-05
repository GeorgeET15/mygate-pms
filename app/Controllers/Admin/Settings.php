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
            'settings' => $model->findAll()
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
}
