<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiModel extends Model
{
    protected $table            = 'realisasi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_anggaran', 'deskripsi', 'total_realisasi'];
    protected $useTimestamps    = false;
}