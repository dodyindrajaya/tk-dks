<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiDetailModel extends Model
{
    protected $table            = 'realisasi_detail';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_realisasi', 'keterangan', 'nilai_realisasi'];

    // Hook untuk update otomatis ke header realisasi
    protected $afterInsert = ['updateHeaderRealisasi'];
    protected $afterUpdate = ['updateHeaderRealisasi'];
    protected $afterDelete = ['updateHeaderRealisasi'];

    protected function updateHeaderRealisasi(array $data)
    {
        $db = \Config\Database::connect();
        
        // Cari ID Realisasi (Header)
        $id_header = $data['id_realisasi'] ?? ($data['data']['id_realisasi'] ?? null);

        if ($id_header) {
            $total = $db->table($this->table)
                        ->where('id_realisasi', $id_header)
                        ->selectSum('nilai_realisasi')
                        ->get()->getRow()->nilai_realisasi;

            $db->table('realisasi')
               ->where('id', $id_header)
               ->update(['total_realisasi' => $total ?? 0]);
        }
        return $data;
    }
}