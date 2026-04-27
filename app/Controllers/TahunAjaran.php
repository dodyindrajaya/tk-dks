<?php

namespace App\Controllers;

use App\Models\TAModel;

class TahunAjaran extends BaseController
{
    public function index()
    {
        $model = new TAModel();
        $data = [
            'title' => 'Master Tahun Ajaran',
            'ta'    => $model->findAll()
        ];
        return view('admin/ta/index', $data);
    }

    public function save()
    {
        $model = new TAModel();
        $model->save([
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'status'       => $this->request->getPost('status')
        ]);
        return redirect()->to('/ta')->with('success', 'Data berhasil disimpan');
    }
    public function update($id)
    {
        $model = new TAModel();
        $model->update($id, [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'status'       => $this->request->getPost('status')
        ]);
        return redirect()->to('/ta')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $model = new TAModel();
        $model->delete($id);
        return redirect()->to('/ta')->with('success', 'Data berhasil dihapus');
    }


}