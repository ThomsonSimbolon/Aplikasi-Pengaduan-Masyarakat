<?php

namespace App\Controllers\lurah;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    protected $usersModel, $lurahModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->lurahModel = new \App\Models\LurahModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'profile' => $this->lurahModel->findAll(),
            'nik' => session()->get('users_nik'),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Profile'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->lurahModel->getProfile($id_user);
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        // Simpan nama lengkap ke dalam session
        session()->set('nama_lengkap');

        if (!$user) {
            return redirect()->to('/auth');
        }

        $datalurah = $this->lurahModel->where('id_user', $id_user)->first();


        return view('lurah/v_profile', $data);
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Profile',
            'active' => 'profile',
            'nik' => session()->get('users_nik'),
            'lurah' => $this->lurahModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Edit Profile'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->lurahModel->getProfile($id_user);
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        return view('lurah/v_edit_profile', $data);
    }


    public function update($id)
    {
        // Get id_user from session
        $id_user = session()->get('users_id');
        $id_mhs = session()->get('id_mhs');

        // Get data lurah from tb_lurah and tb_users
        $profile = $this->lurahModel->getProfile($id_user);


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
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'agama' => [
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
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'jabatan' => [
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
            $profile['foto_profile'] = $newName;
        }

        // Update data in tb_lurah
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nik' => $this->request->getVar('nik'),
            'alamat' => $this->request->getVar('alamat'),
            'agama' => $this->request->getVar('agama'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
            'jabatan' => $this->request->getVar('jabatan'),
            'foto_profile' => isset($newName) ? $newName : $profile['foto_profile'],
        ];

        $this->lurahModel->update($id, $data);



        // Update data in tb_lurah
        // $this->lurahModel->update($profile['id_mhs'], [
        //     'id_user' => $this->request->getPost('id_user'),
        //     'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        //     'nim' => $this->request->getPost('nim'),
        //     'program_studi' => $this->request->getPost('program_studi'),
        //     'tahun_angkatan' => $this->request->getPost('tahun_angkatan'),
        //     'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        //     'tempat_lahir' => $this->request->getPost('tempat_lahir'),
        //     'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        //     'no_hp' => $this->request->getPost('no_hp'),
        //     'alamat' => $this->request->getPost('alamat'),
        //     'upload_foto' => isset($newName) ? $newName : $profile['upload_foto'],
        // ]);



        // Update data in tb_users
        // $this->usersModel->updateUsers($id_user, [
        //     'email' => $this->request->getPost('email'),
        //     'status' => $this->request->getPost('status'),
        // ]);

        // $session = session();
        // $session->set('nama_lengkap', $this->request->getPost('nama_lengkap'));

        // Redirect ke halaman profile
        session()->setFlashdata('success', 'Data profile berhasil diubah');
        return redirect()->to('/lurah/profile')->with('success', 'Data profile berhasil diubah');
    }
}
