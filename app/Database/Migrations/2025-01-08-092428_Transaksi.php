<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_faktur' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'tgl_transaksi' => [
                'type' => 'DATE',
            ],
            'id_purchasing' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'constraint' => 11,
            ],
            'id_admin' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_purchasing', 'purchasing', 'id');
        $this->forge->addForeignKey('id_admin', 'admin', 'id');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
