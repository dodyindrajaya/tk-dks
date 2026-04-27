<?php

namespace App\Controllers;

use App\Models\AnggaranModel; // Asumsi Anda sudah membuat model ini
use App\Models\RealisasiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Mengambil Tahun Ajaran Aktif
        $taAktif = $db->table('tahun_ajaran')->where('status', 'aktif')->get()->getRow();
        $id_ta = $taAktif ? $taAktif->id : 0;

        // Query Dashboard: Data Anggaran vs Realisasi
        $query = $db->query("
            SELECT 
                a.id,
                ta.tahun_ajaran,
                a.deskripsi,
                a.bulan_kegiatan,
                a.total_anggaran as jumlah_anggaran,
                COALESCE(SUM(rd.nilai_realisasi), 0) as jumlah_realisasi
            FROM anggaran a
            JOIN tahun_ajaran ta ON a.id_ta = ta.id
            LEFT JOIN realisasi r ON a.id = r.id_anggaran
            LEFT JOIN realisasi_detail rd ON r.id = rd.id_realisasi
            WHERE a.id_ta = ?
            GROUP BY a.id
        ", [$id_ta]);

        $data = [
            'title'     => 'Dashboard DKS',
            'ta_aktif'  => $taAktif ? $taAktif->tahun_ajaran : 'Belum Set',
            'summary'   => $query->getResultArray()
        ];

        return view('admin/dashboard', $data);
    }
}
