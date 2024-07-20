<?php

namespace App\Controllers\masyarakat;

use App\Controllers\BaseController;

class PertanyaanController extends BaseController
{
    protected $usersModel, $pertanyaanModel, $masyarakatModel, $jawabanModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->pertanyaanModel = new \App\Models\PertanyaanModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
        $this->jawabanModel = new \App\Models\JawabanModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Pertanyaan',
            'active' => 'pertanyaan',
            'nik' => session()->get('users_nik'),
            'pertanyaan' => $this->pertanyaanModel->findAll(),
            'p' => $this->pertanyaanModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Pertanyaan'
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

        return view('masyarakat/v_pertanyaan', $data);
    }

    // Method controller untuk menampilkan dataPribadi
    public function dataPribadi()
    {

        $id_user = session()->get('users_id');

        $data = [
            'title' => 'Data Pribadi',
            'active' => 'pertanyaan',
            'nik' => session()->get('users_nik'),
            'l' => $this->pertanyaanModel->where('id_user', $id_user)->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Data Pribadi'
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

        return view('masyarakat/pribadi/v_pertanyaan', $data);
    }

    // Method controller untuk add pertanyaan
    public function add()
    {
        $data = [
            'title' => 'Tambah Pertanyaan',
            'active' => 'pertanyaan',
            'nik' => session()->get('users_nik'),
            'pertanyaan' => $this->pertanyaanModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Tambah Pertanyaan'
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

        return view('masyarakat/v_tambah_pertanyaan', $data);
    }

    // Method controller untuk create pertanyaan
    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kategori_pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // 'file_path' => [
            //     'rules' => 'uploaded[file_path]|max_size[file_path,1024]|ext_in[file_path,png,jpg,jpeg]',
            //     'errors' => [
            //         'uploaded' => 'Pilih file terlebih dahulu',
            //         'max_size' => 'Ukuran file terlalu besar. Maksimal 1MB',
            //         'ext_in' => 'Hanya file PNG, JPG, JPEG yang diizinkan'
            //     ]
            // ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data pertanyaan gagal ditambah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // insert data kedatabase
        $data = [
            'id_user' => session()->get('users_id'),
            'nik' => $this->request->getVar('nik'),
            'kategori_pertanyaan' => $this->request->getVar('kategori_pertanyaan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->pertanyaanModel->insert($data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pertanyaan
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('masyarakat/pertanyaan'))->with('success', 'Data berhasil ditambah');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pertanyaan
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('masyarakat/pertanyaan'))->with('error', 'Data gagal ditambahkan');
        }
    }

    // Method controller untuk edit data pertanyaan
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pertanyaan',
            'active' => 'pertanyaan',
            'nik' => session()->get('users_nik'),
            'validation' => \Config\Services::validation(),
            'pertanyaan' => $this->pertanyaanModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('masyarakat
                masyarakat/home'),
                'Active Page' => 'Edit Pertanyaan'
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

        return view('masyarakat/v_edit_pertanyaan', $data);
    }

    // Method controller untuk update data pertanyaan
    public function update($id)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'kategori_pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data berita gagal diubah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // insert data kedatabase
        $data = [
            'nik' => $this->request->getVar('nik'),
            'kategori_pertanyaan' => $this->request->getVar('kategori_pertanyaan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->pertanyaanModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('masyarakat/pertanyaan'));
        } else {
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('masyarakat/pertanyaan/edit/' . $id));
        }
    }

    // Method controller untuk detail pertanyaan
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pertanyaan',
            'active' => 'pertanyaan',
            'nik' => session()->get('users_nik'),
            'pertanyaan' => $this->pertanyaanModel->find($id),
            'jawaban' => $this->jawabanModel->where('id_pertanyaan', $id)->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Detail Pertanyaan'
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

        return view('masyarakat/v_detail_pertanyaan', $data);
    }

    // Method controller untuk jawaban dari pertanyaan
    public function tambahJawaban()
    {

        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_user' => 'required',
            'id_pertanyaan' => 'required',
            'jawaban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data pertanyaan gagal ditambah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $nama_lengkap = session()->get('nama_lengkap');

        // insert data kedatabase
        $this->jawabanModel->save([
            'id_user' => session()->get('users_id'),
            'id_pertanyaan' => $this->request->getPost('id_pertanyaan'),
            'nama_lengkap' => $nama_lengkap,
            'nik' => session()->get('nik'),
            'jawaban' => $this->request->getPost('jawaban'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ]);

        // Jika berhasil maka akan dikembalikan ke halaman default dan juga mengirimkan notfikikasi
        return redirect()->to('/masyarakat/pertanyaan/detail/' . $this->request->getPost('id_pertanyaan'))->with('success', 'Data jawaban berhasil ditambahkan.');

        // Jika gagal maka akan dikembalikan ke inputan dan juga menampilkan notifikasi error
        return redirect()->back()->with('error', 'Data komentar gagal ditambahkan.');
    }
}
