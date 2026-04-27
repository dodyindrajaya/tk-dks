<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggaranModel extends Model
{
    protected $table            = 'anggaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_ta', 'deskripsi', 'bulan_kegiatan', 'total_anggaran'];
    
    // Matikan timestamps karena di dump SQL awal kita tidak buat created_at
    protected $useTimestamps    = false;
}