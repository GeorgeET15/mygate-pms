<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;

class Property extends BaseController
{
    protected $propertyModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Manage Properties',
            'properties' => $this->propertyModel->findAll()
        ];
        
        return view('admin/property/index', $data);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->propertyModel->insert($postData)) {
                return redirect()->to('/admin/property')->with('success', 'Property added successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->propertyModel->errors());
        }

        return view('admin/property/create', ['title' => 'Add Property']);
    }

    public function edit($id = null)
    {
        $property = $this->propertyModel->find($id);
        if (!$property) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->propertyModel->update($id, $postData)) {
                return redirect()->to('/admin/property')->with('success', 'Property updated successfully.');
            }

            return redirect()->back()->withInput()->with('errors', $this->propertyModel->errors());
        }

        return view('admin/property/edit', [
            'title'    => 'Edit Property',
            'property' => $property
        ]);
    }

    public function delete($id = null)
    {
        if ($this->propertyModel->delete($id)) {
            return redirect()->to('/admin/property')->with('success', 'Property deleted successfully.');
        }
        return redirect()->to('/admin/property')->with('error', 'Unable to delete property.');
    }
}
