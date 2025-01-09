<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use App\Models\PurchasingModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $pelangganModel = new PelangganModel();
        $purchasingModel = new PurchasingModel();
        $produkModel = new ProdukModel();
        $transaksiModel = new TransaksiModel();
        $data = [
            'title' => 'Halaman Admin',
            'total_admin' => $adminModel->countAllResults(),
            'total_pelanggan' => $pelangganModel->countAllResults(),
            'total_purchasing' => $purchasingModel->countAllResults(),
            'total_produk' => $produkModel->countAllResults(),
            'total_transaksi' => $transaksiModel->countAllResults(),
        ];
        return view('admin/home', $data);
    }

}
