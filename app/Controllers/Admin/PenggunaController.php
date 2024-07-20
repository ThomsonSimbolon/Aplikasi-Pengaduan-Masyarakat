<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PenggunaController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new \App\Models\UsersModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'active' => 'pengguna',
            'nik' => session()->get('users_nik'),
            'pengguna' => $this->usersModel->findAll(),
            'breadcrumb' => [
                'Home' => base_url('admin/home'),
                'Active Page' => 'Pengguna'
            ],
        ];

        return view('admin/v_pengguna', $data);
    }

    // Method controller untuk create data pengguna
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
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data pengguna gagal ditambahkan');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Mengambil data dari database
        $data = [
            'nik' => $this->request->getVar('nik'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getVar('level'),
        ];

        if ($this->usersModel->insert($data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pengguna
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/pengguna'))->with('success', 'Data berhasil ditambah');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pengguna
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Data gagal ditambah');
        }
    }

    // Method controller untuk update data pengguna
    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            session()->setFlashdata('failed', 'Data pengguna gagal diubah');
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Mengambil data dari database
        $data = [
            'nik' => $this->request->getVar('nik'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getVar('level'),
        ];
        if ($this->usersModel->update($id, $data)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pengguna
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/pengguna'))->with('success', 'Data berhasil diubah');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pengguna
            session()->setFlashdata('gagal', 'Data gagal diubah');
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Data gagal diubah');
        }
    }

    // Method controller untuk delete data pengguna
    public function delete($id)
    {
        // Menghapus data pengguna
        if ($this->usersModel->delete($id)) {
            // Jika berhasil maka akan diredirect dan menampilkan notifikasi sukses di halaman pengguna
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/pengguna'))->with('success', 'Data berhasil dihapus');
        } else {
            // Jika gagal maka akan diredirect dan menampilkan notifikasi gagal di halaman pengguna
            session()->setFlashdata('gagal', 'Data gagal dihapus');
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Data gagal dihapus');
        }
    }
}
