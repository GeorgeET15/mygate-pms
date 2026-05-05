<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\PropertyModel;

class Unit extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Units',
            'units' => $this->unitModel->getUnitsWithProperty()
        ];
        
        return view('admin/unit/index', $data);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->unitModel->insert($postData)) {
                return redirect()->to('/admin/unit')->with('success', 'Unit added successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->unitModel->errors());
        }

        return view('admin/unit/create', [
            'title'      => 'Add Unit',
            'properties' => $propertyModel->findAll()
        ]);
    }

    public function edit($id = null)
    {
        $unit = $this->unitModel->find($id);
        if (!$unit) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $propertyModel = new PropertyModel();

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->unitModel->update($id, $postData)) {
                return redirect()->to('/admin/unit')->with('success', 'Unit updated successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->unitModel->errors());
        }

        return view('admin/unit/edit', [
            'title'      => 'Edit Unit',
            'unit'       => $unit,
            'properties' => $propertyModel->findAll()
        ]);
    }

    public function delete($id = null)
    {
        if ($this->unitModel->delete($id)) {
            return redirect()->to('/admin/unit')->with('success', 'Unit deleted successfully.');
        }
        return redirect()->to('/admin/unit')->with('error', 'Unable to delete unit.');
    }
}
