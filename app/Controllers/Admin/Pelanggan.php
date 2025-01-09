<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Pelanggan extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $pelanggan = new PelangganModel();
        $data = [
            'title' => 'Halaman Pelanggan',
            'validation' => Services::validation(),
            'pelanggan' => $pelanggan->findAll()
        ];
        return view('admin/pelanggan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelanggan',
            'validation' => Services::validation()
        ];
        return view('admin/pelanggan/create', $data);
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
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Tambah Data Pelanggan',
                'validation' => $this->validator
            ];
            return view('admin/pelanggan/create', $data);
        } else {
            $pelangganModel = new PelangganModel();
            $pelangganModel->insert([
                'nama' =>  $this->request->getPost('nama'),
                'alamat' =>  $this->request->getPost('alamat')
            ]);
            session()->setFlashdata('berhasil', 'Data purchasing berhasil ditambahkan');
            return redirect()->to('/admin/pelanggan');
        }
    }

    public function edit($id)
    {
        $pelangganModel = new PelangganModel();
        $pelanggan = $pelangganModel->find($id);
        if (!$pelanggan) {
            session()->setFlashdata('Pesan', 'Data tidak tersedia');
            return redirect()->to('/admin/pelanggan');
        }

        $data = [
            'title' => 'Edit Data Pelanggan',
            'validation' => Services::validation(),
            'pelanggan' => $pelanggan
        ];
        return view('admin/pelanggan/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'nama' => 'Nama harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'alamat' => 'Alamat harus diisi'
                ]
            ]
        ];

        $pelangganModel = new PelangganModel();

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Edit Data Pelanggan',
                'validation' => $this->validator,
                'pelanggan' => $pelangganModel->find($id)
            ];
            return view("admin/pelanggan/edit", $data);
        } else {
            $pelangganModel->update($id, [
                'nama' =>  $this->request->getPost('nama'),
                'alamat' =>  $this->request->getPost('alamat')
            ]);
            session()->setFlashdata('berhasil', 'Data pelanggan berhasil diupdate');
            return redirect()->to('/admin/pelanggan');
        }
    }

    public function destroy($id)
    {
        $pelangganModel = new PelangganModel();

        // Cek apakah data dengan ID yang diberikan ada
        $pelanggan = $pelangganModel->find($id);
        if (!$pelanggan) {
            session()->setFlashdata('error', 'Data pelanggan tidak ditemukan.');
            return redirect()->to('/admin/pelanggan');
        }

        // Hapus data
        $pelangganModel->delete($id);
        session()->setFlashdata('berhasil', 'Data pelanggan berhasil dihapus.');
        return redirect()->to('/admin/pelanggan');
    }
}
