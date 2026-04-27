<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun_ajaran' => '2024/2025',
                'status'       => 'aktif',
            ],
        ];

        $this->db->table('tahun_ajaran')->insertBatch($data);
    }
}
