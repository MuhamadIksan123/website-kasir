<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Perusahaan extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $perusahaan = new PerusahaanModel();
        $data = [
            'title' => 'Halaman Perusahaan',
            'validation' => Services::validation(),
            'perusahaan' => $perusahaan->findAll()
        ];
        return view('admin/perusahaan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Perusahaan',
            'validation' => Services::validation()
        ];
        return view('admin/perusahaan/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Perusahaan harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Tambah Data Perusahaan',
                'validation' => $this->validator
            ];
            return view('admin/perusahaan/create', $data);
        } else {
            $pelangganModel = new PerusahaanModel();
            $pelangganModel->insert([
                'nama' =>  $this->request->getPost('nama'),
                'alamat' =>  $this->request->getPost('alamat')
            ]);
            session()->setFlashdata('berhasil', 'Data purchasing berhasil ditambahkan');
            return redirect()->to('/admin/perusahaan');
        }
    }

    public function edit($id)
    {
        $pelangganModel = new PerusahaanModel();
        $perusahaan = $pelangganModel->find($id);
        if (!$perusahaan) {
            session()->setFlashdata('Pesan', 'Data tidak tersedia');
            return redirect()->to('/admin/perusahaan');
        }

        $data = [
            'title' => 'Edit Data Perusahaan',
            'validation' => Services::validation(),
            'perusahaan' => $perusahaan
        ];
        return view('admin/perusahaan/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'nama' => 'Nama Perusahaan harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'alamat' => 'Alamat harus diisi'
                ]
            ]
        ];

        $pelangganModel = new PerusahaanModel();

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Edit Data Perusahaan',
                'validation' => $this->validator,
                'perusahaan' => $pelangganModel->find($id)
            ];
            return view("admin/perusahaan/edit", $data);
        } else {
            $pelangganModel->update($id, [
                'nama' =>  $this->request->getPost('nama'),
                'alamat' =>  $this->request->getPost('alamat')
            ]);
            session()->setFlashdata('berhasil', 'Data perusahaan berhasil diupdate');
            return redirect()->to('/admin/perusahaan');
        }
    }

    public function destroy($id)
    {
        $pelangganModel = new PerusahaanModel();

        // Cek apakah data dengan ID yang diberikan ada
        $perusahaan = $pelangganModel->find($id);
        if (!$perusahaan) {
            session()->setFlashdata('error', 'Data perusahaan tidak ditemukan.');
            return redirect()->to('/admin/perusahaan');
        }

        // Hapus data
        $pelangganModel->delete($id);
        session()->setFlashdata('berhasil', 'Data perusahaan berhasil dihapus.');
        return redirect()->to('/admin/perusahaan');
    }
}
