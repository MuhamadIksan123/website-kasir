<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PurchasingModel;
use App\Models\PerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Purchasing extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $purchasingModel = new PurchasingModel();
        $data = [
            'title' => 'Halaman Purchasing',
            'validation' => Services::validation(),
            'purchasing' => $purchasingModel->data_purchasing(),
        ];
        return view('admin/purchasing/index', $data);
    }

    public function create()
    {
        $perusahaanModel = new PerusahaanModel();

        $data = [
            'title' => 'Tambah Data Purchasing',
            'validation' => Services::validation(),
            'perusahaan' => $perusahaanModel->findAll()
        ];
        return view('admin/purchasing/create', $data);
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
            'id_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perusahaan harus diisi'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Tambah Data Purchasing',
                'validation' => $this->validator
            ];
            return view('admin/purchasing/create', $data);
        } else {
            $purchasingModel = new PurchasingModel();
            $purchasingModel->insert([
                'nama' =>  $this->request->getPost('nama'),
                'id_perusahaan' =>  $this->request->getPost('id_perusahaan'),
            ]);
            session()->setFlashdata('berhasil', 'Data purchasing berhasil ditambahkan');
            return redirect()->to('/admin/purchasing');
        }
    }

    public function edit($id)
    {
        $perusahaanModel = new PerusahaanModel();
        $purchasingModel = new PurchasingModel();
        $data = [
            'title' => 'Edit Data Purchasing',
            'validation' => Services::validation(),
            'purchasing' => $purchasingModel->detail_purchasing($id),
            'perusahaan' => $perusahaanModel->findAll()
        ];
        return view('admin/purchasing/edit', $data);
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
            'id_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perusahaan harus diisi'
                ]
            ]
        ];

        $purchasingModel = new PurchasingModel();

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Edit Data Purchasing',
                'validation' => $this->validator,
                'purchasing' => $purchasingModel->find($id)
            ];
            return view("admin/purchasing/edit", $data);
        } else {
            $purchasingModel->update($id, [
                'nama' =>  $this->request->getPost('nama'),
                'id_perusahaan' =>  $this->request->getPost('id_perusahaan'),
            ]);
            session()->setFlashdata('berhasil', 'Data purchasing berhasil diupdate');
            return redirect()->to('/admin/purchasing');
        }
    }

    public function destroy($id)
    {
        $purchasingModel = new PurchasingModel();

        // Cek apakah data dengan ID yang diberikan ada
        $purchasing = $purchasingModel->find($id);
        if (!$purchasing) {
            session()->setFlashdata('error', 'Data purchasing tidak ditemukan.');
            return redirect()->to('/admin/purchasing');
        }

        // Hapus data
        $purchasingModel->delete($id);
        session()->setFlashdata('berhasil', 'Data purchasing berhasil dihapus.');
        return redirect()->to('/admin/purchasing');
    }
}
