<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use App\Models\PurchasingModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Transaksi extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $data = [
            'title' => 'Halaman Transaksi',
            'validation' => Services::validation(),
            'transaksi' => $transaksiModel->data_transaksi()
        ];
        return view('admin/transaksi/index', $data);
    }

    public function detail($id_transaksi)
    {
        $transaksiModel = new TransaksiModel();
        $data = [
            'title' => 'Halaman Detail Transaksi',
            'validation' => Services::validation(),
            'transaksi' => $transaksiModel->detail_transaksi($id_transaksi)
        ];
        return view('admin/transaksi/detail', $data);
    }

    public function create()
    {
        $pelangganModel = new PelangganModel();
        $purchasingModel = new PurchasingModel();
        $productModel = new ProdukModel();
        $data = [
            'title' => 'Tambah Data Produk',
            'validation' => Services::validation(),
            'pelanggan' => $pelangganModel->findAll(),
            'purchasing' => $purchasingModel->findAll(),
            'produk' => $productModel->findAll()
        ];
        return view('admin/transaksi/create', $data);
    }

    public function store()
    {
        // Aturan validasi
        $rules = [
            'no_faktur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Faktur harus diisi'
                ]
            ],
            'tgl_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Transaksi harus diisi'
                ]
            ],
            'id_pelanggan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pelanggan harus dipilih'
                ]
            ],
            'id_purchasing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Purchasing harus dipilih'
                ]
            ],
            'product_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk harus dipilih'
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah produk harus diisi'
                ]
            ],
        ];

        // Validasi input
        if (! $this->validate($rules)) {
            // Mengambil data yang diperlukan untuk dropdown
            $pelangganModel = new PelangganModel();
            $purchasingModel = new PurchasingModel();
            $produkModel = new ProdukModel();

            $data = [
                'title' => 'Tambah Transaksi',
                'validation' => \Config\Services::validation(),
                'pelanggan' => $pelangganModel->findAll(),
                'purchasing' => $purchasingModel->findAll(),
                'produk' => $produkModel->findAll(),
            ];
            return view('Admin/Transaksi/create', $data);
        } else {
            // Mendapatkan data transaksi dan detail produk
            $transaksiData = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tgl_transaksi' => $this->request->getPost('tgl_transaksi'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'id_purchasing' => $this->request->getPost('id_purchasing'),
                'id_admin' => session()->get('id_admin'), // Assuming you have an admin session
            ];

            $produkNames = $this->request->getPost('product_old'); // Seharusnya product_name bukan product_old
            $quantities = $this->request->getPost('quantity');

            log_message('info', 'Data Produk: ' . print_r($produkNames, true));
            log_message('info', 'Data Quantity: ' . print_r($quantities, true));

            // Mulai transaksi database
            $db = \Config\Database::connect();
            $db->transBegin();

            try {
                // Masukkan data transaksi
                $transaksiModel = new TransaksiModel();
                $transaksiModel->insert($transaksiData);
                $id_transaksi = $transaksiModel->insertID(); // Mendapatkan ID transaksi yang baru dimasukkan

                log_message('info', 'ID Transaksi yang baru dimasukkan: ' . $id_transaksi);

                // Persiapkan data untuk detail transaksi
                $detailData = [];
                foreach ($produkNames as $index => $kode_produk) {
                    // Pastikan quantity ada dan lebih dari 0
                    $quantity = isset($quantities[$index]) ? (int) $quantities[$index] : 0;
                    if ($quantity > 0) {
                        $detailData[] = [
                            'id_transaksi' => $id_transaksi,
                            'kode_produk' => $kode_produk,
                            'total_produk' => $quantity,
                        ];
                    }
                }

                // Pastikan ada data untuk dimasukkan
                if (!empty($detailData)) {
                    log_message('info', 'Detail Transaksi: ' . print_r($detailData, true));
                    $detailTransaksiModel = new DetailTransaksiModel();
                    $detailTransaksiModel->insertBatch($detailData); // Gunakan insertBatch untuk memasukkan beberapa data sekaligus
                } else {
                    log_message('warning', 'Tidak ada detail transaksi untuk disimpan');
                }

                // Commit transaksi jika semua data berhasil dimasukkan
                $db->transCommit();
                session()->setFlashdata('berhasil', 'Transaksi berhasil disimpan');
                return redirect()->to('/admin/transaksi');
            } catch (\Exception $e) {
                // Rollback transaksi jika ada error
                $db->transRollback();
                log_message('error', 'Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage());
                session()->setFlashdata('gagal', 'Terjadi kesalahan. Transaksi tidak berhasil disimpan');
                return redirect()->to('/admin/transaksi');
            }
        }
    }
}
