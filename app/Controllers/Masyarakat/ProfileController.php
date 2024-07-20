<?php

namespace App\Controllers\masyarakat;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    protected $usersModel, $masyarakatModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'profile' => $this->masyarakatModel->findAll(),
            'nik' => session()->get('users_nik'),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Profile'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->masyarakatModel->getProfile($id_user);
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        // Simpan nama lengkap ke dalam session
        session()->set('nama_lengkap');

        if (!$user) {
            return redirect()->to('/auth');
        }

        $dataMasyarakat = $this->masyarakatModel->where('id_user', $id_user)->first();


        return view('masyarakat/v_profile', $data);
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Profile',
            'active' => 'profile',
            'nik' => session()->get('users_nik'),
            'masyarakat' => $this->masyarakatModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Edit Profile'
            ],
        ];

        // Mengambil id_user dari session
        $id_user = session()->get('users_id');
        $user = $this->usersModel->find($id_user);
        $profile = $this->usersModel->where('id_user', $id_user)->first();
        $profile = $this->masyarakatModel->getProfile($id_user);
        // // // Menggabungkan data yang akan dikirim ke view dalam satu array
        $data['profile'] = $profile;
        $data['user'] = $user;

        return view('masyarakat/v_edit_profile', $data);
    }


    public function update($id)
    {
        // Get id_user from session
        $id_user = session()->get('users_id');
        $id_mhs = session()->get('id_mhs');

        // Get data masyarakat from tb_masyarakat and tb_users
        $profile = $this->masyarakatModel->getProfile($id_user);


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
            $profile['foto_profile'] = $newName;
        }

        // Update data in tb_masyarakat
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nik' => $this->request->getVar('nik'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'agama' => $this->request->getVar('agama'),
            'no_telp' => $this->request->getVar('no_telp'),
            'tgl_lahir' => date('Y-m-d'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status' => $this->request->getVar('status'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'foto_profile' => isset($newName) ? $newName : $profile['foto_profile'],
        ];

        $this->masyarakatModel->update($id, $data);



        // Update data in tb_masyarakat
        // $this->masyarakatModel->update($profile['id_mhs'], [
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
        return redirect()->to('/masyarakat/profile')->with('success', 'Data profile berhasil diubah');
    }
}
