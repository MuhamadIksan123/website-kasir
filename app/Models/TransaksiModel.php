<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = [
        'no_faktur',
        'tgl_transaksi',
        'id_pelanggan',
        'id_purchasing',
        'id_admin'
    ];

    public function data_transaksi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->select('transaksi.*, pelanggan.nama as nama_pelanggan, purchasing.nama as nama_purchasing, admin.nama as nama_admin');
        $builder->join('pelanggan', 'pelanggan.id = transaksi.id_pelanggan');
        $builder->join('purchasing', 'purchasing.id = transaksi.id_purchasing');
        $builder->join('admin', 'admin.id = transaksi.id_admin');
        return $builder->get()->getResultArray();
    }

    public function detail_transaksi($id_transaksi)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->select('
        transaksi.id_transaksi,
        transaksi.no_faktur,
        transaksi.tgl_transaksi,
        pelanggan.nama AS nama_pelanggan, 
        pelanggan.alamat AS alamat_pelanggan,
        purchasing.nama AS nama_purchasing, 
        admin.nama AS nama_admin,
        detail_transaksi.total_produk,
        produk.harga, 
        produk.satuan, 
        produk.nama_produk, 
        produk.kode_produk,
        SUM(detail_transaksi.total_produk * produk.harga) AS total_harga
    ');
        $builder->join('pelanggan', 'pelanggan.id = transaksi.id_pelanggan');
        $builder->join('purchasing', 'purchasing.id = transaksi.id_purchasing');
        $builder->join('admin', 'admin.id = transaksi.id_admin');
        $builder->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $builder->join('produk', 'produk.kode_produk = detail_transaksi.kode_produk');
        $builder->where('transaksi.id_transaksi', $id_transaksi);

        // Tambahkan semua kolom non-agregat ke dalam klausa GROUP BY
        $builder->groupBy([
            'transaksi.id_transaksi',
            'transaksi.no_faktur',
            'transaksi.tgl_transaksi',
            'pelanggan.nama',
            'pelanggan.alamat',
            'purchasing.nama',
            'admin.nama',
            'detail_transaksi.total_produk',
            'produk.harga',
            'produk.satuan',
            'produk.nama_produk',
            'produk.kode_produk'
        ]);

        return $builder->get()->getResultArray();
    }


}
