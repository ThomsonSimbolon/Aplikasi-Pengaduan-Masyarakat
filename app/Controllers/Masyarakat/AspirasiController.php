<?php

namespace App\Controllers\masyarakat;

use App\Controllers\BaseController;

class AspirasiController extends BaseController
{
    protected $usersModel, $aspirasiModel, $masyarakatModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->aspirasiModel = new \App\Models\AspirasiModel();
        $this->masyarakatModel = new \App\Models\MasyarakatModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'aspirasi' => $this->aspirasiModel->where('status', 'Selesai')->findAll(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Aspirasi'
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

        return view('masyarakat/v_aspirasi', $data);
    }

    // Method controller untuk menampilkan dataPribadi
    public function dataPribadi()
    {

        $id_user = session()->get('users_id');

        $data = [
            'title' => 'Data Pribadi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'a' => $this->aspirasiModel->where('id_user', $id_user)->findAll(),
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

        return view('masyarakat/pribadi/v_aspirasi', $data);
    }

    // Method controller untuk add data aspirasi
    public function add()
    {
        $data = [
            'title' => 'Tambah Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'aspirasi' => $this->aspirasiModel->find(),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Tambah Aspirasi'
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

        return view('masyarakat/v_tambah_aspirasi', $data);
    }

    // Method controller untuk create data aspirasi
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
            'kategori_aspirasi' => [
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
            'rt_rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'lampiran' => [
                'rules' => 'uploaded[lampiran]|max_size[lampiran,10240]|ext_in[lampiran,png,jpg,jpeg,gif,mp4,avi,doc,docx,pdf]',
                'errors' => [
                    'uploaded' => 'Pilih file terlebih dahulu',
                    'max_size' => 'Ukuran file terlalu besar. Maksimal 10MB',
                    'ext_in' => 'Hanya file PNG, JPG, JPEG, GIF, MP4, AVI, DOC, DOCX, PDF yang diizinkan'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data aspirasi gagal ditambah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"
        $lampiran = $this->request->getFile('lampiran');
        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            $newName = $lampiran->getRandomName();
            $lampiran->move(ROOTPATH . 'public/assets/uploads/', $newName);

            // insert data kedatabase
            $data = [
                'id_user' => session()->get('users_id'),
                'nik' => $this->request->getVar('nik'),
                'kategori_aspirasi' => $this->request->getVar('kategori_aspirasi'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'rt_rw' => $this->request->getVar('rt_rw'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'tgl_aspirasi' => date('Y-m-d H:i:s'),
                'tgl_aspirasi' => date('Y-m-d H:i:s'),
                'tgl_update' => date('Y-m-d H:i:s'),
                'lampiran' => $newName
                // 'nik' => session()->get('users_nik')
            ];

            if ($this->aspirasiModel->insert($data)) {
                // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman aspirasi
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('masyarakat/aspirasi'))->with('success', 'Data berhasil ditambah.');
            } else {
                // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman aspirasi
                session()->setFlashdata('gagal', 'Data gagal ditambahkan');
                return redirect()->to(base_url('masyarakat/aspirasi/add'))->with('error', 'Data gagal ditambah');;
            }
        }
    }

    // Method controller untuk edit data aspirasi
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'validation' => \Config\Services::validation(),
            'aspirasi' => $this->aspirasiModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Edit Aspirasi'
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

        return view('masyarakat/v_edit_aspirasi', $data);
    }

    // Method controller untuk update data aspirasi
    public function update($id)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'kategori_aspirasi' => [
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
            'rt_rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            // 'lampiran' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} wajib diisi'
            //     ]
            // ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data berita gagal ditambahkan');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }


        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"
        $lampiran = $this->request->getFile('lampiran');
        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            $newName = $lampiran->getRandomName();
            $lampiran->move(ROOTPATH . 'public/assets/uploads/', $newName);

            $aspirasi = $this->aspirasiModel->find($id);

            if ($aspirasi->lampiran && file_exists(ROOTPATH . 'public/assets/uploads/' . $aspirasi->lampiran)) {
                unlink(ROOTPATH . 'public/assets/uploads/' . $aspirasi->lampiran);
            }
        } else {
            $newName = $this->aspirasiModel->find($id)->lampiran;
        }

        // insert data kedatabase
        $data = [
            'id_user' => session()->get('users_id'),
            'nik' => session()->get('users_nik'),
            'kategori_aspirasi' => $this->request->getVar('kategori_aspirasi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'tgl_aspirasi' => date('Y-m-d H:i:s'),
            'tgl_aspirasi' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'lampiran' => $newName
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->aspirasiModel->update($id, $data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman aspirasi
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('masyarakat/aspirasi'));
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman aspirasi
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('masyarakat/aspirasi/edit/' . $id));
        }
    }

    // Method controller untuk detail data aspirasi
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'aspirasi' => $this->aspirasiModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('masyarakat/home'),
                'Active Page' => 'Detail Aspirasi'
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

        return view('masyarakat/v_detail_aspirasi', $data);
    }
}
