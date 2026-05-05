<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{
    public function index()
    {
        $session = session();
        
        if ($session->get('admin_login') == 1) {
            return redirect()->to('/admin/dashboard');
        }

        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('email', $email)
                            ->where('password', $password)
                            ->first();

        if ($admin) {
            $session->set([
                'login_type'  => 'admin',
                'admin_login' => 1,
                'admin_id'    => $admin['admin_id'],
                'name'        => $admin['name'] ?? 'Admin'
            ]);
            
            return redirect()->to('/admin/dashboard');
        }

        $session->setFlashdata('error', 'Invalid email or password.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
