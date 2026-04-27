<?php

namespace App\Controllers;

use App\Models\RealisasiModel;
use App\Models\RealisasiDetailModel;
use App\Models\AnggaranModel;

class Realisasi extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $data['realisasi'] = $db->table('realisasi r')
            ->select('r.*, a.deskripsi as nama_anggaran, ta.tahun_ajaran')
            ->join('anggaran a', 'a.id = r.id_anggaran')
            ->join('tahun_ajaran ta', 'ta.id = a.id_ta')
            ->get()->getResultArray();
        
        $data['anggaran_list'] = (new AnggaranModel())->findAll();
        $data['title'] = "Realisasi DKS";

        return view('admin/realisasi/index', $data);
    }

    public function detail($id)
    {
        $model = new RealisasiModel();
        $detailModel = new RealisasiDetailModel();

        $data['header'] = $model->find($id);
        $data['details'] = $detailModel->where('id_realisasi', $id)->findAll();
        $data['title'] = "Detail Realisasi";

        return view('admin/realisasi/detail', $data);
    }

    public function save()
    {
        (new RealisasiModel())->save([
            'id_anggaran' => $this->request->getPost('id_anggaran'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'total_realisasi' => 0
        ]);
        return redirect()->to('/realisasi');
    }

    public function save_detail($id_realisasi)
    {
        (new RealisasiDetailModel())->save([
            'id_realisasi'    => $id_realisasi,
            'keterangan'      => $this->request->getPost('keterangan'),
            'nilai_realisasi' => $this->request->getPost('nilai_realisasi')
        ]);
        return redirect()->to('/realisasi/detail/'.$id_realisasi);
    }

    public function delete_detail($id, $id_realisasi)
    {
        (new RealisasiDetailModel())->delete($id);
        return redirect()->to('/realisasi/detail/'.$id_realisasi);
    }
}