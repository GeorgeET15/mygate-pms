<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\QuickLinkModel;

class QuickLink extends BaseController
{
    protected $linkModel;

    public function __construct()
    {
        $this->linkModel = new QuickLinkModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Quick Links',
            'links' => $this->linkModel->findAll()
        ];

        return view('admin/quick_link/index', $data);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            if ($this->linkModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/quicklink')->with('success', 'Link added.');
            }
        }
        return view('admin/quick_link/create', ['title' => 'Add Link']);
    }

    public function delete($id = null)
    {
        $this->linkModel->delete($id);
        return redirect()->to('/admin/quicklink')->with('success', 'Deleted.');
    }
}
