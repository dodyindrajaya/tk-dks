<?php

namespace App\Controllers;

use App\Models\AnggaranModel;
use App\Models\AnggaranDetailModel;
use App\Models\TAModel;

class Anggaran extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        // Ambil data anggaran join dengan Tahun Ajaran
        $data['anggaran'] = $db->table('anggaran a')
            ->select('a.*, ta.tahun_ajaran')
            ->join('tahun_ajaran ta', 'ta.id = a.id_ta')
            ->get()->getResultArray();
        
        $data['ta_list'] = (new TAModel())->findAll();
        $data['title'] = "Data Anggaran DKS";

        return view('admin/anggaran/index', $data);
    }

    public function detail($id)
    {
        $model = new AnggaranModel();
        $detailModel = new AnggaranDetailModel();

        $data['header'] = $model->find($id);
        $data['details'] = $detailModel->where('id_anggaran', $id)->findAll();
        $data['title'] = "Detail Anggaran: " . $data['header']['deskripsi'];

        return view('admin/anggaran/detail', $data);
    }

    public function save()
    {
        (new AnggaranModel())->save([
            'id_ta' => $this->request->getPost('id_ta'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'bulan_kegiatan' => $this->request->getPost('bulan_kegiatan'),
            'total_anggaran' => 0 // Akan terisi otomatis saat detail ditambah
        ]);
        return redirect()->to('/anggaran');
    }

    public function save_detail($id_anggaran)
    {
        $detailModel = new AnggaranDetailModel();
        $jumlah = $this->request->getPost('jumlah_satuan');
        $harga = $this->request->getPost('harga_satuan');

        $detailModel->save([
            'id_anggaran' => $id_anggaran,
            'nama_item' => $this->request->getPost('nama_item'),
            'jumlah_satuan' => $jumlah,
            'harga_satuan' => $harga,
            'subtotal' => $jumlah * $harga
        ]);

        return redirect()->to('/anggaran/detail/'.$id_anggaran);
    }
    public function delete_detail($id, $id_anggaran)
{
    $detailModel = new \App\Models\AnggaranDetailModel();
    $detailModel->delete($id);
    
    // Karena kita sudah buat afterDelete di Model, 
    // total_anggaran di header akan otomatis berkurang sendiri.
    
    return redirect()->to('/anggaran/detail/'.$id_anggaran);
}
}