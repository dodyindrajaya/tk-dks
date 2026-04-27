<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropExistingTables extends Migration
{
    public function up()
    {
        $this->forge->dropTable('realisasi_detail', true);
        $this->forge->dropTable('realisasi', true);
        $this->forge->dropTable('anggaran', true);
        $this->forge->dropTable('tahun_ajaran', true);
        $this->forge->dropTable('users', true);
    }

    public function down()
    {
        // No rollback needed for drop operations
    }
}
