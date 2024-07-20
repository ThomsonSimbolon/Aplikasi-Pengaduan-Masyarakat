<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PertanyaanController extends BaseController
{
    protected $usersModel, $pertanyaanModel, $jawabanModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->pertanyaanModel = new \App\Models\PertanyaanModel();
        $this->jawabanModel = new \App\Models\JawabanModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Pertanyaan',
            'active' => 'pertanyaan',
            'pertanyaan' => $this->pertanyaanModel->findAll(),
            'nik' => session()->get('users_nik'),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Pertanyaan'
            ],
        ];

        return view('admin/v_pertanyaan', $data);
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Tambah Pertanyaan'
            ],
        ];

        return view('admin/v_tambah_pertanyaan', $data);
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

        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"

        // Proses upload file
        $file_path = $this->request->getFile('file_path');
        $newName = '';

        if ($file_path && $file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads/', $newName);
        }
        // insert data kedatabase
        $data = [
            'id_user' => session()->get('users_id'),
            'nik' => $this->request->getVar('nik'),
            'kategori_pertanyaan' => $this->request->getVar('kategori_pertanyaan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'file_path' => $newName
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->pertanyaanModel->insert($data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pertanyaan
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('admin/pertanyaan'))->with('pesan', 'Data berhasil ditambah');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pertanyaan
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('admin/pertanyaan'))->with('error', 'Data gagal ditambahkan');
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Edit Pertanyaan'
            ],
        ];

        return view('admin/v_edit_pertanyaan', $data);
    }

    // Method controller untuk update data pertanyaan
    public function update($id)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
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

        $file_path = $this->request->getFile('file_path');
        if ($file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads/', $newName);

            $pertanyaan = $this->pertanyaanModel->find($id);

            if ($pertanyaan->file_path && file_exists(ROOTPATH . 'public/assets/uploads/' . $pertanyaan->file_path)) {
                unlink(ROOTPATH . 'public/assets/uploads/' . $pertanyaan->file_path);
            }
        } else {
            $newName = $this->pertanyaanModel->find($id)->file_path;
        }

        // insert data kedatabase
        $data = [
            'nik' => $this->request->getVar('nik'),
            'kategori_pertanyaan' => $this->request->getVar('kategori_pertanyaan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'file_path' => $newName,
            // 'nik' => session()->get('users_nik')
        ];

        if ($this->pertanyaanModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/pertanyaan'));
        } else {
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('admin/pertanyaan/edit/' . $id));
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
                'Home' => base_url('admin/home'),
                'Active Page' => 'Detail Pertanyaan'
            ],
        ];

        return view('admin/v_detail_pertanyaan', $data);
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

        $nama_lengkap = session()->get('users_nik');

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
        return redirect()->to('/admin/pertanyaan/detail/' . $this->request->getPost('id_pertanyaan'))->with('success', 'Data jawaban berhasil ditambahkan.');

        // Jika gagal maka akan dikembalikan ke inputan dan juga menampilkan notifikasi error
        return redirect()->back()->with('error', 'Data jawaban gagal ditambahkan.');
    }

    // Method function untuk update data jawaban
    public function updateJawaban($id_jawaban)
    {
        // Aturan validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([

            'jawaban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if ($this->request->getMethod() === 'post' && !$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data edit jawaban gagal ditambahkan');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }


        $nama_lengkap = session()->get('users_nik');

        $data = [
            'id_pertanyaan' => $this->request->getPost('id_pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
            'tgl_pertanyaan' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        if ($this->jawabanModel->update($id_jawaban, $data)) {
            return redirect()->to('/admin/pertanyaan/detail/' . $this->request->getPost('id_pertanyaan'))->with('success', 'Jawaban berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Gagal diubah jawaban.');
        }

        return redirect()->back()->with('error', 'Data jawaban gagal diubah.');
    }

    // Method function untuk menghapusn data jawaban
    public function deleteJawaban($id)
    {
        // Cek apakah id_jawaban valid
        if (!empty($id)) {
            // Hapus jawaban berdasarkan id_jawaban
            $deleted = $this->jawabanModel->delete($id);

            // Cek apakah jawaban berhasil dihapus
            if ($deleted) {
                // Jika berhasil, alihkan kembali ke halaman detail diskusi
                return redirect()->back()->with('hapus', 'jawaban berhasil dihapus.');
                // session()->setFlashdata('hapus', 'Data jawaban berhasil dihapus.');
            } else {
                // Jika gagal, kembalikan dengan pesan error
                return redirect()->back()->with('failed', 'Gagal menghapus jawaban.');
            }
        } else {
            // Jika id_jawaban tidak valid, kembalikan dengan pesan error
            return redirect()->back()->with('failed', 'ID jawaban tidak valid.');
        }

        session()->setFlashdata('hapus', 'Data jawaban berhasil dihapus.');
        return redirect()->to('/admin/pernyataan/detail/')->with('hapus', 'Data jawaban berhasil dihapus.');
    }


    // Method controller untuk delete pertanyaan
    public function delete($id)
    {
        if ($this->pertanyaanModel->delete($id)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pertanyaan
            session()->setFlashdata('hapus', 'Data berhasil dihapus');
            return redirect()->to(base_url('admin/pertanyaan'));
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pertanyaan
            session()->setFlashdata('gagal', 'Data gagal dihapus');
            return redirect()->to(base_url('admin/pertanyaan'));
        }
    }
}
