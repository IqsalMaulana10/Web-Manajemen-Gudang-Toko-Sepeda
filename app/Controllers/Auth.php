<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/produk');
        }
        return view('auth/login');
    }
    public function login()
    {
        $session = session();
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            if ($password === $user['password']) {
                $ses_data = [
                    'id_user'   => $user['id_user'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama_lengkap'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/produk');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to(uri: '/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}