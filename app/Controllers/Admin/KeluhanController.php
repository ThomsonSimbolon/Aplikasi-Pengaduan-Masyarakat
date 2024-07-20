<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KeluhanController extends BaseController
{
    protected $usersModel, $keluhanModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
        $this->keluhanModel = new \App\Models\KeluhanModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Keluhan',
            'active' => 'keluhan',
            'nik' => session()->get('users_nik'),
            'keluhan' => $this->keluhanModel->findAll(),
            // 'k' => $this->keluhanModel->where('status', 'Menunggu')->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Keluhan'
            ],
        ];

        return view('admin/v_keluhan', $data);
    }

    // Method controller untuk add keluhan
    public function add()
    {
        $data = [
            'title' => 'Tambah Keluhan',
            'active' => 'keluhan',
            'nik' => session()->get('users_nik'),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Tambah Keluhan'
            ],
        ];

        return view('admin/v_tambah_keluhan', $data);
    }

    // Method controller untuk create keluhan
    public function create()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pengadu' => [
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
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'judul_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'deskripsi_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
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
            'kategori_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'solusi_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data keluhan gagal ditambah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses upload file "Notes: Upload directory harus di public didalam app/config/App"
        $file_path = $this->request->getFile('file_path');
        if ($file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads/', $newName);

            // insert data kedatabase
            $data = [
                'id_user' => session()->get('users_id'),
                'nik' => session()->get('users_nik'),
                'nama_pengadu' => $this->request->getVar('nama_pengadu'),
                'rt_rw' => $this->request->getVar('rt_rw'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'no_telp' => $this->request->getVar('no_telp'),
                'judul_keluh' => $this->request->getVar('judul_keluh'),
                'deskripsi_keluh' => $this->request->getVar('deskripsi_keluh'),
                'tgl_pengadu' => date('Y-m-d H:i:s'),
                'tgl_update' => date('Y-m-d H:i:s'),
                'file_path' => $newName,
                'kategori_keluh' => $this->request->getVar('kategori_keluh'),
                'solusi_keluh' => $this->request->getVar('solusi_keluh'),
                'status' => 'Selesai'
                // 'nik' => session()->get('users_nik')
            ];

            if ($this->keluhanModel->insert($data)) {
                // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman keluhan
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to(base_url('admin/keluhan'))->with('success', 'Data berhasil ditambah');
            } else {
                // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman keluhan
                session()->setFlashdata('gagal', 'Data gagal ditambahkan');
                return redirect()->to(base_url('admin/keluhan'))->with('error', 'Data gagal ditambah');
            }
        }
    }

    // Method controller untuk edit data keluhan
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Keluhan',
            'active' => 'keluhan',
            'nik' => session()->get('users_nik'),
            'validation' => \Config\Services::validation(),
            'keluhan' => $this->keluhanModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Edit Keluhan'
            ],
        ];

        return view('admin/v_edit_keluhan', $data);
    }

    // Method controller untuk update data keluhan
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
            'nama_pengadu' => [
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
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'judul_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'deskripsi_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'kategori_keluh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi'
                ]
            ],
            'solusi_keluh' => [
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

        $file_path = $this->request->getFile('file_path');
        if ($file_path->isValid() && !$file_path->hasMoved()) {
            $newName = $file_path->getRandomName();
            $file_path->move(ROOTPATH . 'public/assets/uploads/', $newName);

            $keluhan = $this->keluhanModel->find($id);

            if ($keluhan->file_path && file_exists(ROOTPATH . 'public/assets/uploads/' . $keluhan->file_path)) {
                unlink(ROOTPATH . 'public/assets/uploads/' . $keluhan->file_path);
            }
        } else {
            $newName = $this->keluhanModel->find($id)->file_path;
        }

        $data = [
            'nama_pengadu' => $this->request->getVar('nama_pengadu'),
            'rt_rw' => $this->request->getVar('rt_rw'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'no_telp' => $this->request->getVar('no_telp'),
            'judul_keluh' => $this->request->getVar('judul_keluh'),
            'deskripsi_keluh' => $this->request->getVar('deskripsi_keluh'),
            'tgl_pengadu' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'file_path' => $newName,
            'kategori_keluh' => $this->request->getVar('kategori_keluh'),
            'solusi_keluh' => $this->request->getVar('solusi_keluh'),
        ];

        if ($this->keluhanModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/keluhan'));
        } else {
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('admin/keluhan/edit/' . $id));
        }
    }

    // Method controller untuk detail keluhan
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Keluhan',
            'active' => 'keluhan',
            'nik' => session()->get('users_nik'),
            'keluhan' => $this->keluhanModel->find($id),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Detail Keluhan'
            ],
        ];

        return view('admin/v_detail_keluhan', $data);
    }

    // Method controller untuk halaman konfirmasi keluhan
    public function konfirmasi()
    {
        $data = [
            'title' => 'Konfirmasi Keluhan',
            'active' => 'keluhan',
            'nik' => session()->get('users_nik'),
            'k' => $this->keluhanModel->whereIn('status', ['Menunggu', 'Diproses'])->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Konfirmasi Keluhan'
            ],
        ];
        return view('admin/konfirmasi/v_konfirmasi_keluhan', $data);
    }

    // Method controller untuk approve keluhan
    public function approveKeluhan($id_keluhan)
    {
        $this->keluhanModel->update($id_keluhan, ['status' => 'Selesai', 'tgl_update' => date('Y-m-d H:i:s')]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to(site_url('admin/keluhan'))->with('selesai', 'Keluhan berhasil disetujui.');
    }

    // Method controller untuk memproses keluhan
    public function processKeluhan($id_keluhan)
    {
        $this->keluhanModel->update($id_keluhan, ['status' => 'Diproses', 'tgl_update' => date('Y-m-d H:i:s')]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to(site_url('admin/keluhan'))->with('diproses', 'Keluhan berhasil diproses.');
    }

    // Method controller untuk delete keluhan
    public function delete($id)
    {
        if ($this->keluhanModel->delete($id)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman keluhan
            session()->setFlashdata('hapus', 'Data berhasil dihapus');
            return redirect()->to(base_url('admin/keluhan'))->with('hapus', 'Data berhasil dihapus');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman keluhan
            session()->setFlashdata('gagal', 'Data gagal dihapus');
            return redirect()->to(base_url('admin/keluhan'))->with('failed', 'Data gagal dihapus');
        }
    }
}
