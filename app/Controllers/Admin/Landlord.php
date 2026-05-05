<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LandlordModel;

class Landlord extends BaseController
{
    protected $landlordModel;

    public function __construct()
    {
        $this->landlordModel = new LandlordModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Manage Landlords',
            'landlords' => $this->landlordModel->findAll()
        ];

        return view('admin/landlord/index', $data);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            if ($this->landlordModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/landlord')->with('success', 'Landlord added.');
            }
        }
        return view('admin/landlord/create', ['title' => 'Add Landlord']);
    }

    public function delete($id = null)
    {
        $this->landlordModel->delete($id);
        return redirect()->to('/admin/landlord')->with('success', 'Deleted.');
    }
}
