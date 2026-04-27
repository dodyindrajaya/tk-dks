<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Jika sudah login, langsung ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = trim($this->request->getVar('username'));
        $password = trim($this->request->getVar('password'));

        $user = $model->where('username', $username)->first();

        if ($user) {
            // Menggunakan password_verify (pastikan di database password sudah di-hash)
    

            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'      => $user['id'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'role'         => $user['role'],
                    'logged_in'    => TRUE
                ];
                $session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password salah.xxx');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function setupAdminz()
    {
        $model = new \App\Models\UserModel();
        
        // Hapus user admin lama jika ada agar tidak duplikat
        $model->where('username', 'admin')->delete();

        $data = [
            'username'     => 'admin',
            'password'     => password_hash('admin123', PASSWORD_BCRYPT),
            'nama_lengkap' => 'Administrator TK',
            'role'         => 'admin'
        ];

        if ($model->insert($data)) {
            return "User Admin berhasil dibuat! Silakan coba login dengan password: admin123";
        } else {
            return "Gagal membuat user.";
        }
    }


}