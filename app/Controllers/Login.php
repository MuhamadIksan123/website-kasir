<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('login', $data);
    }

    public function login_action()
    {
        $session = session();
        $modelLogin = new LoginModel();

        // Ambil input dari user
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ];

        // Aturan validasi
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('login', $data);
        }

        // Cek username di database
        $user = $modelLogin->where('username', $data['username'])->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($data['password'], $user['password'])) {
                $session_data = [
                    'logged_in' => true,
                    'role_id' => $user['role'],
                    'nama' => $user['nama'],
                    'id_admin' => $user['id'],
                ];
                session()->set($session_data);

                // Role-based redirect
                if ($user['role'] === 'Admin') {
                    return redirect()->to('/admin');
                } else {
                    $session->setFlashdata('pesan', 'Role tidak valid.');
                    return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('pesan', 'Password salah.');
                return redirect()->to('/');
            }
        } else {
            $session->setFlashdata('pesan', 'Username tidak ditemukan.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
