<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->is('post')) {

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'isLoggedIn' => true,
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                ]);

                return redirect()->to(site_url('customers'));
            }

            return redirect()->back()->with('error', 'Invalid username or password.');
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}