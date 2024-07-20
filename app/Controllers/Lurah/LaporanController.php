<?php

namespace App\Controllers\lurah;

use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    protected $usersModel, $laporanModel, $lurahModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->laporanModel = new \App\Models\LaporanModel();
        $this->lurahModel = new \App\Models\LurahModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Laporan',
            'active' => 'laporan',
            'nik' => session()->get('users_nik'),
            'laporan' => $this->laporanModel->where('status', 'Selesai')->findAll(),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Laporan'
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

        return view('lurah/v_laporan', $data);
    }

    // Method controller untuk menampilkan dataPribadi
    public function dataPribadi()
    {

        $id_user = session()->get('users_id');

        $data = [
            'title' => 'Data Pribadi',
            'active' => 'laporan',
            'nik' => session()->get('users_nik'),
            'l' => $this->laporanModel->where('id_user', $id_user)->findAll(),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Data Pribadi'
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

        return view('lurah/pribadi/v_laporan', $data);
    }

    // Method controller untuk add data laporan
    public function add()
    {
        $data = [
            'title' => 'Tambah Laporan',
            'active' => 'laporan',
            'nik' => session()->get('users_nik'),
            'laporan' => $this->laporanModel->find(),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Tambah Laporan'
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

        return view('lurah/v_tambah_laporan', $data);
    }

    // Method controller untuk create data laporan
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
            'judul_laporan' => [
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
            'kecamatan' => [
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
            session()->setFlashdata('failed', 'Data laporan gagal ditambah');
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
                'judul_laporan' => $this->request->getVar('judul_laporan'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'tgl_laporan' => date('Y-m-d H:i:s'),
                'tgl_update' => date('Y-m-d H:i:s'),
                'rt_rw' => $this->request->getVar('rt_rw'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'lampiran' => $newName
                // 'nik' => session()->get('users_nik')
            ];

            if ($this->laporanModel->insert($data)) {
                // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman laporan
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('lurah/laporan'))->with('success', 'Data berhasil ditambah');
            } else {
                // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman laporan
                session()->setFlashdata('gagal', 'Data gagal ditambahkan');
                return redirect()->to(base_url('lurah/laporan'))->with('error', 'Data gagal ditambah');
            }
        }
    }

    // Method controller untuk edit data laporan
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Laporan',
            'active' => 'laporan',
            'nik' => session()->get('users_nik'),
            'validation' => \Config\Services::validation(),
            'laporan' => $this->laporanModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Edit Laporan'
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

        return view('lurah/v_edit_laporan', $data);
    }

    // Method controller untuk update data laporan
    public function update($id)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_laporan' => [
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
                    'required' => '{field} wajib diisi'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
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

            $laporan = $this->laporanModel->find($id);

            if ($laporan->lampiran && file_exists(ROOTPATH . 'public/assets/uploads/' . $laporan->lampiran)) {
                unlink(ROOTPATH . 'public/assets/uploads/' . $laporan->lampiran);
            }
        } else {
            $newName = $this->laporanModel->find($id)->lampiran;
        }

        // insert data kedatabase
        $data = [
            'id_user' => session()->get('users_id'),
            'nik' => $this->request->getVar('nik'),
            'judul_laporan' => $this->request->getVar('judul_laporan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_laporan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'lampiran' => $newName
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->laporanModel->update($id, $data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman laporan
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('lurah/laporan'));
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman laporan
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('lurah/laporan/edit/' . $id));
        }
    }

    // Method controller untuk detail data laporan
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Laporan',
            'active' => 'laporan',
            'nik' => session()->get('users_nik'),
            'laporan' => $this->laporanModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('lurah/home'),
                'Active Page' => 'Detail Laporan'
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

        return view('lurah/v_detail_laporan', $data);
    }
}
