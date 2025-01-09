<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Produk extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $produk = new ProdukModel();
        $data = [
            'title' => 'Halaman Produk',
            'validation' => Services::validation(),
            'produk' => $produk->findAll()
        ];
        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Produk',
            'validation' => Services::validation()
        ];
        return view('admin/produk/create', $data);
    }

    public function store()
    {
        $rules = [
            'kode_produk' => [
                'rules' => 'required|is_unique[produk.kode_produk]',
                'errors' => [
                    'required' => 'Kode Produk harus diisi',
                    'is_unique' => 'Kode Produk harus unik'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga Produk harus diisi'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan Produk harus diisi'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Tambah Data Produk',
                'validation' => $this->validator
            ];
            return view('admin/produk/create', $data);
        } else {
            $produkModel = new ProdukModel();
            $produkModel->insert([
                'kode_produk' =>  $this->request->getPost('kode_produk'),
                'nama_produk' =>  $this->request->getPost('nama_produk'),
                'harga' =>  $this->request->getPost('harga'),
                'satuan' =>  $this->request->getPost('satuan'),
            ]);
            session()->setFlashdata('berhasil', 'Data produk berhasil ditambahkan');
            return redirect()->to('/admin/produk');
        }
    }

    public function edit($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);
        if (!$produk) {
            session()->setFlashdata('Pesan', 'Data tidak tersedia');
            return redirect()->to('/admin/produk');
        }

        $data = [
            'title' => 'Edit Data Produk',
            'validation' => Services::validation(),
            'produk' => $produk
        ];
        return view('admin/produk/edit', $data);
    }

    public function update($kode_produk)
    {
        $rules = [
            'kode_produk' => [
                'rules' => 'required|is_unique[produk.kode_produk,kode_produk,' . $kode_produk . ']',
                'errors' => [
                    'required' => 'Kode Produk harus diisi',
                    'is_unique' => 'Kode Produk harus unik'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Produk harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan Produk harus diisi'
                ]
            ],
        ];

        $produkModel = new ProdukModel();

        if (! $this->validate($rules)) {
            $data = [
                'title' => 'Edit Data Produk',
                'validation' => $this->validator,
                'produk' => $produkModel->where('kode_produk', $kode_produk)->first()
            ];
            return view("admin/produk/edit", $data);
        } else {
            $produkModel->where('kode_produk', $kode_produk)->set([
                'kode_produk' =>  $this->request->getPost('kode_produk'),
                'nama_produk' =>  $this->request->getPost('nama_produk'),
                'harga' =>  $this->request->getPost('harga'),
                'satuan' =>  $this->request->getPost('satuan'),
            ])->update();

            session()->setFlashdata('berhasil', 'Data produk berhasil diupdate');
            return redirect()->to('/admin/produk');
        }
    }


    public function destroy($id)
    {
        $produkModel = new ProdukModel();

        // Cek apakah data dengan ID yang diberikan ada
        $produk = $produkModel->find($id);
        if (!$produk) {
            session()->setFlashdata('error', 'Data produk tidak ditemukan.');
            return redirect()->to('/admin/produk');
        }

        // Hapus data
        $produkModel->delete($id);
        session()->setFlashdata('berhasil', 'Data produk berhasil dihapus.');
        return redirect()->to('/admin/produk');
    }
}
