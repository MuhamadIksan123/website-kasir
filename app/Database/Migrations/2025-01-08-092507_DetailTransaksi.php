<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'constraint' => 11,
            ],
            'kode_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'total_produk' => [
                'type'       => 'INT',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kode_produk', 'produk', 'kode_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi');
    }
}
