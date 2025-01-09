<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'kode_produk';
    protected $allowedFields    = [
        'kode_produk',
        'nama_produk',
        'harga',
        'satuan'
    ];
}
