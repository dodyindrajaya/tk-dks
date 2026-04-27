<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\TAModel;

class Siswa extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        // Query untuk mengambil data siswa dan nama tahun ajaran-nya
        $data['siswa'] = $db->table('siswa s')
            ->select('s.*, ta.tahun_ajaran')
            ->join('tahun_ajaran ta', 'ta.id = s.id_ta')
            ->get()->getResultArray();
            
        $data['ta_list'] = (new TAModel())->findAll();
        $data['title']   = "Master Data Siswa";

        return view('admin/siswa/index', $data);
    }

    public function save()
    {
        (new SiswaModel())->save([
            'nis'        => $this->request->getPost('nis'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'kelas'      => $this->request->getPost('kelas'),
            'id_ta'      => $this->request->getPost('id_ta')
        ]);
        return redirect()->to('/siswa')->with('success', 'Data Siswa berhasil ditambah');
    }

    public function delete($id)
    {
        (new SiswaModel())->delete($id);
        return redirect()->to('/siswa')->with('success', 'Data Siswa berhasil dihapus');
    }
}