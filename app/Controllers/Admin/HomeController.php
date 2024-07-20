<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    protected $usersModel, $pertanyaanModel, $keluhanModel, $laporanModel, $aspirasiModel, $masyarakatModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->pertanyaanModel = new \App\Models\PertanyaanModel();
        $this->keluhanModel = new \App\Models\KeluhanModel();
        $this->laporanModel = new \App\Models\LaporanModel();
        $this->aspirasiModel = new \App\Models\AspirasiModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'nik' => session()->get('users_nik'),
            'active' => 'admin',
            'masyarakat' => $this->masyarakatModel->getAllMasyarakat(),
            'total_users' => $this->usersModel->countUsers(),
            'nama_lengkap' => session()->get('nama_lengkap'),
            'total_aspirasi' => $this->aspirasiModel->countAspirasi(),
            'total_keluhan' => $this->keluhanModel->countKeluhan(),
            'total_laporan' => $this->laporanModel->countLaporan(),
            'total_pertanyaan' => $this->pertanyaanModel->countPertanyaan(),
            'pertanyaan' => $this->pertanyaanModel->findAll(),
            'keluhan' => json_encode($this->formatData($this->keluhanModel->getMonthlyCounts())),
            'laporan' => json_encode($this->formatData($this->laporanModel->getMonthlyCounts())),
            'aspirasi' => json_encode($this->formatData($this->aspirasiModel->getMonthlyCounts())),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                // 'admin' => base_url('admin/dashboard'),
                'Active Page' => 'Dashboard'
            ],
        ];

        $data['keluhan'] = $data['keluhan'] ?? [];
        $data['laporan'] = $data['laporan'] ?? [];
        $data['aspirasi'] = $data['aspirasi'] ?? [];

        return view('admin/v_home', $data);
    }

    private function formatData($data)
    {
        $formattedData = array_fill(1, 12, 0); // initialize array with 12 months

        foreach ($data as $entry) {
            $formattedData[(int)$entry['month']] = $entry['count'];
        }

        return array_values($formattedData); // return values as array
    }

    // Method controller untuk edit data masyarakat
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Masyarakat',
            'nik' => session()->get('users_nik'),
            'active' => 'admin',
            'nama_lengkap' => session()->get('nama_lengkap'),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                // 'admin' => base_url('admin/dashboard'),
                'Active Page' => 'Edit Data Masyarakat'
            ],
            'masyarakat' => $this->masyarakatModel->find($id),
        ];

        return view('admin/v_edit_masyarakat', $data);
    }

    // Method controller untuk update data masyarakat
    public function update($id)
    {
        $id_mhs = session()->get('id_mhs');


        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'rt_rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            // 'foto_profile' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} tidak boleh kosong',
            //     ],
            // ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data profile gagal diubah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $foto_profile = $this->request->getFile('foto_profile');
        if ($foto_profile && $foto_profile->isValid() && !$foto_profile->hasMoved()) {
            $newName = $foto_profile->getRandomName();
            $foto_profile->move(ROOTPATH . 'public/uploads/profile', $newName);
        }


        $profile = $this->masyarakatModel->find($id);

        // Update data in tb_masyarakat
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nik' => $this->request->getVar('nik'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'no_telp' => $this->request->getVar('no_telp'),
            'tgl_lahir' => date('Y-m-d'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status' => $this->request->getVar('status'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'foto_profile' => isset($newName) ? $newName : $profile['foto_profile'],
        ];

        $this->masyarakatModel->update($id, $data);

        // Redirect ke halaman profile
        session()->setFlashdata('success', 'Data profile berhasil diubah');
        return redirect()->to('admin/home')->with('success', 'Data profile berhasil diubah');
    }

    // Method controller untuk menampilkan data masyarakat
    public function masyarakat($id)
    {
        $data = [
            'title' => 'Detail Masyarakat',
            'nik' => session()->get('users_nik'),
            'active' => 'admin',
            'nama_lengkap' => session()->get('nama_lengkap'),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                // 'admin' => base_url('admin/dashboard'),
                'Active Page' => 'Detail Masyarakat'
            ],
            'masyarakat' => $this->masyarakatModel->find($id),
        ];

        return view('admin/v_detail_masyarakat', $data);
    }
}
