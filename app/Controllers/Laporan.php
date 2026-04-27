<?php

namespace App\Controllers;

use App\Models\AnggaranModel;
use App\Models\TAModel;

class Laporan extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_ta = $this->request->getGet('id_ta');
        
        // Query Gabungan Anggaran vs Realisasi
        $builder = $db->table('anggaran a')
            ->select('a.deskripsi, a.total_anggaran, r.total_realisasi, (a.total_anggaran - r.total_realisasi) as selisih')
            ->join('realisasi r', 'r.id_anggaran = a.id', 'left');
        
        if ($id_ta) {
            $builder->where('a.id_ta', $id_ta);
        }

        $data = [
            'title'   => 'Laporan Anggaran vs Realisasi DKS',
            'laporan' => $builder->get()->getResultArray(),
            'ta_list' => (new TAModel())->findAll(),
            'id_ta'   => $id_ta
        ];

        return view('admin/laporan/index', $data);
    }
}