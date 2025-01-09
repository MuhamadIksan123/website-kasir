<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchasingModel extends Model
{
    protected $table            = 'purchasing';
    protected $allowedFields    = [
        'nama',
        'id_perusahaan'
    ];

    public function data_purchasing()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('purchasing');
        $builder->select('purchasing.*, perusahaan.nama as nama_perusahaan');
        $builder->join('perusahaan', 'perusahaan.id = purchasing.id_perusahaan');
        return $builder->get()->getResultArray();
    }

    public function detail_purchasing($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('purchasing');
        $builder->select('purchasing.*, perusahaan.nama as nama_perusahaan');
        $builder->join('perusahaan', 'perusahaan.id = purchasing.id_perusahaan');
        $builder->where('purchasing.id', $id);
        return $builder->get()->getRowArray();
    }
}
