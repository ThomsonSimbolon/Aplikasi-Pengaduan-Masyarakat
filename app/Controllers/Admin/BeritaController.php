<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BeritaController extends BaseController
{
    protected $usersModel, $beritaModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\usersModel();
        $this->beritaModel = new \App\Models\BeritaModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Berita',
            'berita' => $this->beritaModel->findAll(),
            'active' => 'berita',
            'nik' => session()->get('users_nik'),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Berita'
            ],
        ];

        return view('admin/v_berita', $data);
    }

    // Method function untuk menampilkan halaman tambah data forum berita
    public function add()
    {
        // Cek apakah pengguna belum login
        if (!session('logged_in')) {
            return redirect()->to('/auth');
        }

        $data = [
            'title' => 'Tambah Berita',
            'active' => 'berita',
            'berita' => $this->beritaModel->findAll(),
            'nama_lengkap' => session()->get('users_nama_lengkap'),
            'nik' => session()->get('users_nik'),
            'level' => session()->get('users_level'),
            'validation' => \Config\Services::validation(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Data Berita'
            ]
        ];

        return view('admin/v_tambah_berita', $data);
    }

    // Method function untuk post data data berita
    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'file_path' => [
                'rules' => 'uploaded[file_path]|max_size[file_path,1024]|ext_in[file_path,png,jpg,jpeg]',
                'errors' => [
                    'uploaded' => 'Pilih file terlebih dahulu',
                    'max_size' => 'Ukuran file terlalu besar. Maksimal 1MB',
                    'ext_in' => 'Hanya file PNG, JPG, JPEG yang diizinkan'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data pengetahuan gagal diubah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"
        $file_path = $this->request->getFile('file_path');
        if ($file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads/', $newName);
        }

        // Simpan data ke database
        $data = [
            'id_user' => session()->get('users_id'),
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'penulis' => $this->request->getPost('penulis'),
            'url' => $this->request->getPost('url'),
            'file_path' => $newName,
            'tgl_publikasi' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        if ($this->beritaModel->insert($data)) {
            // Jika berhasil, tambahkan notifikasi
            //  $notifikasiModel = new NotifikasiModel();
            //  $notifikasiModel->save([
            //      'type' => 'berita',
            //      'pesan' => 'Berita baru telah ditambahkan.'
            //  ]);

            // Menampilkan pesan materi berhasil ditambah
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/admin/berita')->with('success', 'Data berhasil ditambahkan.');
        } else {
            // Menampilkan pesan materi gagal ditambah
            session()->setFlashdata('pesan', 'Data gagal ditambahkan');
            return redirect()->to('/admin/berita')->with('error', 'Data gagal ditambahkan');
        }
    }

    // Method function untuk menampilkan halaman edit data forum
    public function edit($id)
    {
        // Cek apakah pengguna belum login
        if (!session('logged_in')) {
            return redirect()->to('/auth');
        }

        $data = [
            'title' => 'Edit Berita',
            'active' => 'berita',
            'berita' => $this->beritaModel->findAll(),
            'nama_lengkap' => session()->get('users_nama_lengkap'),
            'nik' => session()->get('users_nik'),
            'level' => session()->get('users_level'),
            'validation' => \Config\Services::validation(),
            'berita' => $this->beritaModel->find($id),
            'breadcrumb' => [
                'admin' => base_url('admin/dashboard'),
                'Active Page' => 'Edit Forum Berita'
            ]
        ];

        return view('admin/v_edit_berita', $data);
    }

    // Method function untuk mengubah data forum
    public function update($id)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'isi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data berita gagal ditambahkan');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $berita = $this->beritaModel->find($id);

        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"
        $file_path = $this->request->getFile('file_path');
        if ($file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads', $newName);
        }

        $data = [
            'id_user' => session()->get('users_id'),
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'penulis' => $this->request->getPost('penulis'),
            'url' => $this->request->getPost('url'),
            'file_path' => isset($newName) ? $newName : $berita->file_path,
            'tgl_publikasi' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        if ($this->beritaModel->update($id, $data)) {
            // Jika berhasil, tambahkan notifikasi
            session()->setFlashdata('pesan', 'Data berita berhasil diubah.');
            return redirect()->to('/admin/berita');
        } else {
            // Jika gagal maka akan menampilkan notifikasi gagal
            session()->setFlashdata('pesan', 'Data berita gagal diubah.');
            return redirect()->to('/admin/berita');
        }
    }

    // Method function untuk menghapus data forum
    public function delete($id)
    {
        $this->beritaModel->delete($id);
        session()->setFlashdata('hapus', 'Data berita berhasil dihapus.');
        return redirect()->to('/admin/berita');
    }
}
