<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NoticeModel;

class Notice extends BaseController
{
    protected $noticeModel;

    public function __construct()
    {
        $this->noticeModel = new NoticeModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Noticeboard',
            'notices' => $this->noticeModel->orderBy('create_timestamp', 'DESC')->findAll()
        ];

        return view('admin/notice/index', $data);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $data = [
                'notice_title'      => $this->request->getPost('notice_title'),
                'notice'            => $this->request->getPost('notice'),
                'create_timestamp'  => time()
            ];

            if ($this->noticeModel->insert($data)) {
                return redirect()->to('/admin/notice')->with('success', 'Notice added successfully.');
            }
        }

        return view('admin/notice/create', ['title' => 'Add Notice']);
    }

    public function edit($id = null)
    {
        $notice = $this->noticeModel->find($id);
        if (!$notice) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        if ($this->request->is('post')) {
            $data = [
                'notice_title' => $this->request->getPost('notice_title'),
                'notice'       => $this->request->getPost('notice')
            ];

            if ($this->noticeModel->update($id, $data)) {
                return redirect()->to('/admin/notice')->with('success', 'Notice updated successfully.');
            }
        }

        return view('admin/notice/edit', ['title' => 'Edit Notice', 'notice' => $notice]);
    }

    public function delete($id = null)
    {
        $this->noticeModel->delete($id);
        return redirect()->to('/admin/notice')->with('success', 'Notice deleted successfully.');
    }
}
