<?php

namespace App\Controllers\masyarakat;

use App\Controllers\BaseController;

class BeritaController extends BaseController
{
    protected $usersModel, $beritaModel, $masyarakatModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->beritaModel = new \App\Models\BeritaModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Masyarakat | Berita',
            'active' => 'berita',
            'nik' => session()->get('users_nik'),
            'berita' => $this->beritaModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Berita'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->masyarakatModel->getProfile($id_user);
        $nama_lengkap = $profile['nama_lengkap'];
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        // Simpan nama lengkap ke dalam session
        session()->set('nama_lengkap', $nama_lengkap);

        return view('masyarakat/v_berita', $data);
    }
}
