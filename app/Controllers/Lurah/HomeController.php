<?php

namespace App\Controllers\lurah;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    protected $aspirasiModel, $keluhanModel, $laporanModel, $pertanyaanModel, $usersModel, $masyarakatModel, $lurahModel;

    public function __construct()
    {
        $this->aspirasiModel = new \App\Models\AspirasiModel();
        $this->keluhanModel = new \App\Models\KeluhanModel();
        $this->laporanModel = new \App\Models\LaporanModel();
        $this->pertanyaanModel = new \App\Models\PertanyaanModel();
        $this->usersModel = new \App\Models\UsersModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
        $this->lurahModel = new \App\Models\LurahModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'active' => 'lurah',
            'nik' => session()->get('users_nik'),
            'masyarakat' => $this->masyarakatModel->getAllMasyarakat(),
            'nama_lengkap' => session()->get('nama_lengkap'),
            'total_aspirasi' => $this->aspirasiModel->countAspirasi(),
            'total_keluhan' => $this->keluhanModel->countKeluhan(),
            'total_laporan' => $this->laporanModel->countLaporan(),
            'total_pertanyaan' => $this->pertanyaanModel->countPertanyaan(),
            'breadcrumb' => [
                'Home' => base_url('home/dashboard'),
                'Active Page' => 'Dashboard'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->lurahModel->getProfile($id_user);
        $nama_lengkap = $profile['nama_lengkap'];
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        // Simpan nama lengkap ke dalam session
        session()->set('nama_lengkap', $nama_lengkap);

        return view('lurah/v_home', $data);
    }
}
