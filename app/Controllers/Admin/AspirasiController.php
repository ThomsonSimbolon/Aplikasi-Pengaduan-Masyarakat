<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AspirasiController extends BaseController
{
    protected $usersModel, $aspirasiModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\usersModel();
        $this->aspirasiModel = new \App\Models\AspirasiModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'aspirasi' => $this->aspirasiModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Aspirasi'
            ],
        ];

        return view('admin/v_aspirasi', $data);
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Tambah Aspirasi'
            ],
        ];

        return view('admin/v_tambah_aspirasi', $data);
    }

    // Method controller untuk create data aspirasi
    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
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
                'nik' => session()->get('users_nik'),
                'kategori_aspirasi' => $this->request->getVar('kategori_aspirasi'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'rt_rw' => $this->request->getVar('rt_rw'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'tgl_aspirasi' => date('Y-m-d H:i:s'),
                'tgl_update' => date('Y-m-d H:i:s'),
                'lampiran' => $newName,
                'status' => 'Selesai',
            ];

            if ($this->aspirasiModel->insert($data)) {
                // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman aspirasi
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('admin/aspirasi'))->with('success', 'Data berhasil ditambah.');
            } else {
                // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman aspirasi
                session()->setFlashdata('gagal', 'Data gagal ditambahkan');
                return redirect()->to(base_url('admin/aspirasi/add'))->with('error', 'Data gagal ditambah');;
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Edit Aspirasi'
            ],
        ];

        return view('admin/v_edit_aspirasi', $data);
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
            'kategori_aspirasi' => $this->request->getVar('kategori_aspirasi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'tgl_aspirasi' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'lampiran' => $newName
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->aspirasiModel->update($id, $data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman aspirasi
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/aspirasi'))->with('success', 'Data berhasil diubah');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman aspirasi
            session()->setFlashdata('failed', 'Data gagal diubah');
            return redirect()->to(base_url('admin/aspirasi/edit/' . $id))->with('failed', 'Data gagal diubah');
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Detail Aspirasi'
            ],
        ];

        return view('admin/v_detail_aspirasi', $data);
    }

    // Method controller untuk halaman konfirmasi aspirasi
    public function konfirmasi()
    {
        $data = [
            'title' => 'Konfirmasi Aspirasi',
            'active' => 'aspirasi',
            'nik' => session()->get('users_nik'),
            'a' => $this->aspirasiModel->whereIn('status', ['Menunggu', 'Diproses'])->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Konfirmasi Aspirasi'
            ],
        ];
        return view('admin/konfirmasi/v_konfirmasi_aspirasi', $data);
    }

    // Method controller untuk approve aspirasi
    public function approveaspirasi($id_aspirasi)
    {
        $this->aspirasiModel->update($id_aspirasi, ['status' => 'Selesai', 'tgl_update' => date('Y-m-d H:i:s')]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to(site_url('admin/aspirasi'))->with('selesai', 'aspirasi berhasil disetujui.');
    }

    // Method controller untuk memproses aspirasi
    public function processaspirasi($id_aspirasi)
    {
        $this->aspirasiModel->update($id_aspirasi, ['status' => 'Diproses', 'tgl_update' => date('Y-m-d H:i:s')]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to(site_url('admin/aspirasi'))->with('diproses', 'aspirasi berhasil diproses.');
    }


    // Method controller untuk delete data aspirasi
    public function delete($id)
    {
        if ($this->aspirasiModel->delete($id)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman aspirasi
            session()->setFlashdata('hapus', 'Data berhasil dihapus');
            return redirect()->to(base_url('admin/aspirasi'))->with('hapus', 'Data berhasil dihapus');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman aspirasi
            session()->setFlashdata('gagal', 'Data gagal dihapus');
            return redirect()->to(base_url('admin/aspirasi'))->with('failed', 'Data gagal dihapus');
        }
    }
}
