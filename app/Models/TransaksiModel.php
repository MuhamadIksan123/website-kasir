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
        'id_purchasing',
        'id_admin'
    ];

    public function data_transaksi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->select('transaksi.*, purchasing.nama as nama_purchasing, perusahaan.nama as nama_perusahaan, admin.nama as nama_admin');
        $builder->join('purchasing', 'purchasing.id = transaksi.id_purchasing');
        $builder->join('admin', 'admin.id = transaksi.id_admin');
        $builder->join('perusahaan', 'perusahaan.id = purchasing.id_perusahaan');
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
        purchasing.nama AS nama_purchasing, 
        perusahaan.nama AS nama_perusahaan,
        perusahaan.alamat AS alamat_perusahaan,
        admin.nama AS nama_admin,
        detail_transaksi.total_produk,
        produk.harga, 
        produk.satuan, 
        produk.nama_produk, 
        produk.kode_produk,
        SUM(detail_transaksi.total_produk * produk.harga) AS total_harga
    ');
        $builder->join('purchasing', 'purchasing.id = transaksi.id_purchasing');
        $builder->join('perusahaan', 'perusahaan.id = purchasing.id_perusahaan');
        $builder->join('admin', 'admin.id = transaksi.id_admin');
        $builder->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        $builder->join('produk', 'produk.kode_produk = detail_transaksi.kode_produk');
        $builder->where('transaksi.id_transaksi', $id_transaksi);

        // Tambahkan semua kolom non-agregat ke dalam klausa GROUP BY
        $builder->groupBy([
            'transaksi.id_transaksi',
            'transaksi.no_faktur',
            'transaksi.tgl_transaksi',
            'purchasing.nama',
            'perusahaan.nama',
            'perusahaan.alamat',
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
