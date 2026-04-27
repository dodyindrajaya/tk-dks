<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnggaranTable extends Migration
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
            'id_ta' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'bulan_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'total_anggaran' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => '0.00',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('anggaran', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('anggaran');
    }
}
