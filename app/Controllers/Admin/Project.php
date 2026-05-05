<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;

class Project extends BaseController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Projects',
            'projects' => $this->projectModel->findAll()
        ];

        return view('admin/project/index', $data);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            if ($this->projectModel->insert($this->request->getPost())) {
                return redirect()->to('/admin/project')->with('success', 'Project added successfully.');
            }
        }

        return view('admin/project/create', ['title' => 'Add Project']);
    }

    public function edit($id = null)
    {
        $project = $this->projectModel->find($id);
        if (!$project) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        if ($this->request->is('post')) {
            if ($this->projectModel->update($id, $this->request->getPost())) {
                return redirect()->to('/admin/project')->with('success', 'Project updated successfully.');
            }
        }

        return view('admin/project/edit', ['title' => 'Edit Project', 'project' => $project]);
    }

    public function delete($id = null)
    {
        $this->projectModel->delete($id);
        return redirect()->to('/admin/project')->with('success', 'Project deleted successfully.');
    }
}
