<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MarketingModel;
use App\Models\PropertyModel;

class Marketing extends BaseController
{
    protected $marketingModel;

    public function __construct()
    {
        $this->marketingModel = new MarketingModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Marketing',
            'listings'  => $this->marketingModel->findAll()
        ];

        return view('admin/marketing/index', $data);
    }

    public function create()
    {
        $propertyModel = new PropertyModel();
        if ($this->request->is('post')) {
            if ($this->marketingModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/marketing')->with('success', 'Added.');
            }
        }
        return view('admin/marketing/create', ['title' => 'Add Listing', 'properties' => $propertyModel->findAll()]);
    }

    public function delete($id = null)
    {
        $this->marketingModel->delete($id);
        return redirect()->to('/admin/marketing')->with('success', 'Deleted.');
    }
}
