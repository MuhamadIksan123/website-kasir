<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Purchasing extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_perusahaan' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_perusahaan', 'perusahaan', 'id');
        $this->forge->createTable('purchasing');
    }

    public function down()
    {
        $this->forge->dropTable('purchasing');
    }
}
