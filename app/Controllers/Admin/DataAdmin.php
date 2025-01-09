<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class DataAdmin extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $data_admin = new AdminModel();
        $data = [
            'title' => 'Halaman Admin',
            'validation' => Services::validation(),
            'data_admin' => $data_admin->findAll()
        ];
        return view('admin/data_admin/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Admin',
            'validation' => Services::validation()
        ];
        return view('admin/data_admin/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => 'Username harus diisi'
            ],
            'password' => [
                'rules' => 'required',
                'errors' => 'Password harus diisi'
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi',
                    'matches' => 'Konfirmasi Password dan Password tidak sama'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Tambah Data Admin',
                'validation' => $this->validator
            ];
            return view('admin/data_admin/create', $data);
        } else {
            $adminModel = new AdminModel();
            $adminModel->insert([
                'nama' =>  $this->request->getPost('nama'),
                'username' =>  $this->request->getPost('username'),
                'role' =>  'Admin',
                'password' =>  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);
            session()->setFlashdata('berhasil', 'Data admin berhasil ditambahkan');
            return redirect()->to('/admin/data_admin');
        }
    }

    public function edit($id)
    {
        $adminModel = new AdminModel();
        $data_admin = $adminModel->find($id);
        if (!$data_admin) {
            session()->setFlashdata('Pesan', 'Data tidak tersedia');
            return redirect()->to('/admin/data_admin');
        }

        $data = [
            'title' => 'Edit Data Admin',
            'validation' => Services::validation(),
            'data_admin' => $data_admin
        ];
        return view('admin/data_admin/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => 'Username harus diisi'
            ],
        ];

        $adminModel = new AdminModel();

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Edit Data Admin',
                'validation' => $this->validator,
                'data_admin' => $adminModel->find($id)
            ];
            return view("admin/data_admin/edit", $data);
        } else {
            // Cek apakah password diperbarui
            if ($this->request->getPost('password') == '') {
                $password = $this->request->getPost('password_lama');
            } else {
                $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $adminModel->update($id, [
                'nama' =>  $this->request->getPost('nama'),
                'username' =>  $this->request->getPost('username'),
                'password' =>  $password,
            ]);
            session()->setFlashdata('berhasil', 'Data admin berhasil diupdate');
            return redirect()->to('/admin');
        }
    }

    public function destroy($id)
    {
        $adminModel = new AdminModel();

        // Cek apakah data dengan ID yang diberikan ada
        $data_admin = $adminModel->find($id);
        if (!$data_admin) {
            session()->setFlashdata('error', 'Data data_admin tidak ditemukan.');
            return redirect()->to('/admin/data_admin');
        }

        // Hapus data
        $adminModel->delete($id);
        session()->setFlashdata('berhasil', 'Data data_admin berhasil dihapus.');
        return redirect()->to('/admin/data_admin');
    }
}
