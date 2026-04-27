<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggaranDetailModel extends Model
{
    protected $table            = 'anggaran_detail';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_anggaran', 'nama_item', 'jumlah_satuan', 'harga_satuan', 'subtotal'];

    // Hook untuk otomatis update total di header
    protected $afterInsert = ['updateHeader'];
    protected $afterUpdate = ['updateHeader'];
    protected $afterDelete = ['updateHeader'];

    protected function updateHeader(array $data)
    {
        $db = \Config\Database::connect();

        // Logika untuk mendapatkan id_anggaran tergantung jenis event-nya
        $id_header = null;
        if (isset($data['id_anggaran'])) {
            $id_header = $data['id_anggaran'];
        } elseif (isset($data['data']['id_anggaran'])) {
            $id_header = $data['data']['id_anggaran'];
        }

        if ($id_header) {
            // Hitung total dari semua detail milik id_anggaran ini
            $total = $db->table($this->table)
                        ->where('id_anggaran', $id_header)
                        ->selectSum('subtotal')
                        ->get()->getRow()->subtotal;

            // Update total_anggaran di tabel master (anggaran)
            $db->table('anggaran')
               ->where('id', $id_header)
               ->update(['total_anggaran' => $total ?? 0]);
        }

        return $data;
    }
}