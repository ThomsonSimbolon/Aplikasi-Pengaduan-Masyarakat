<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\LurahModel;
use App\Models\MasyarakatModel;
use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $helpers = ['form', 'url'];

    protected $model, $masyarakatModel, $lurahModel, $beritaModel;

    public function __construct()
    {
        $this->model = new UsersModel();
        $this->masyarakatModel = new MasyarakatModel();
        $this->lurahModel = new LurahModel();
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Halaman Utama',
            'validation' => \Config\Services::validation(),
            'berita' => $this->beritaModel->findAll(),
        ];

        // Jika validasi sukses, lanjutkan ke halaman berikutnya
        return view('auth/v_index', $data);
    }

    public function formLogin()
    {
        $data = [
            'title' => 'Form Login',
            'validation' => \Config\Services::validation(),
        ];

        // Jika validasi sukses, lanjutkan ke halaman berikutnya
        return view('auth/v_login', $data);
    }


    public function login()
    {
        // Aturan validasi untuk input nik dan password
        $rules = [
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nik tidak boleh kosong',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 6 karakter',
                ],
            ],
        ];

        // Memanggil library validasi
        if (!$this->validate($rules)) {
            return view('auth/v_login', [
                'title' => 'Form Login',
                'validation' => $this->validator
            ]);
        }

        // Jika validasi sukses, lanjutkan dengan proses login
        $model = new UsersModel();

        $nik = $this->request->getVar('nik');
        $password = $this->request->getVar('password');

        // Mengambil data user dari database berdasarkan nik
        $user = $model->where('nik', $nik)->first();

        // Cek login jika user ditemukan dan melakukan pengecekan password
        if ($user) {
            if (password_verify($password, $user->password)) {

                // Jika password cocok, lakukan proses login
                session()->set([
                    'users_id' => $user->id_user,
                    'users_nik' => $user->nik,
                    'users_password' => $user->password,
                    'users_level' => $user->level,
                    'logged_in' => true,
                ]);

                // Redirect sesuai dengan level pengguna
                switch (session()->get('users_level')) {
                    case 'lurah':
                        // // Simpan id_user ke tabel tb_dosen jika belum ada
                        $lurahModel = new LurahModel();
                        $lurah = $lurahModel->where('id_user', $user->id_user)->first();

                        if (!$lurah) {
                            $data = [
                                'id_user' => $user->id_user,
                                'nama_lengkap' => '', // Isi dengan data lain yang diperlukan
                                'nik' => '', // Isi dengan data lain yang diperlukan
                                'alamat' => '', // Isi dengan data lain yang diperlukan
                                'agama' => '', // Isi dengan data lain yang diperlukan
                                'no_telp' => '', // Isi dengan data lain yang diperlukan
                                'tgl_lahir' => '', // Isi dengan data lain yang diperlukan
                                'jenis_kelamin' => '', // Isi dengan data lain yang diperlukan
                                'status' => '', // Isi dengan data lain yang diperlukan
                                'pekerjaan' => '', // Isi dengan data lain yang diperlukan
                                'foto_profile' => '', // Isi dengan data lain yang diperlukan
                            ];

                            $lurahModel->insert($data);
                        }

                        return redirect()->to('/lurah/home');
                    case 'masyarakat':
                        // // Simpan id_user ke tabel tb_dosen jika belum ada
                        $masyarakatModel = new MasyarakatModel();
                        $masyarakat = $masyarakatModel->where('id_user', $user->id_user)->first();

                        if (!$masyarakat) {
                            $data = [
                                'id_user' => $user->id_user,
                                'nama_lengkap' => '', // Isi dengan data lain yang diperlukan
                                'nik' => '', // Isi dengan data lain yang diperlukan
                                'rt_rw' => '', // Isi dengan data lain yang diperlukan
                                'kelurahan' => '', // Isi dengan data lain yang diperlukan
                                'kecamatan' => '', // Isi dengan data lain yang diperlukan
                                'kabupaten' => '', // Isi dengan data lain yang diperlukan
                                'agama' => '', // Isi dengan data lain yang diperlukan
                                'no_telp' => '', // Isi dengan data lain yang diperlukan
                                'tgl_lahir' => '', // Isi dengan data lain yang diperlukan
                                'jenis_kelamin' => '', // Isi dengan data lain yang diperlukan
                                'status' => '', // Isi dengan data lain yang diperlukan
                                'pekerjaan' => '', // Isi dengan data lain yang diperlukan
                                'foto_profile' => '', // Isi dengan data lain yang diperlukan
                            ];

                            $masyarakatModel->insert($data);
                        }

                        return redirect()->to('/masyarakat/home');
                    case 'admin':
                        return redirect()->to('/admin/home');
                    default:
                        return redirect()->to('/auth/formLogin');
                }
            } else {
                // Jika password tidak cocok, tampilkan pesan error
                session()->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                return redirect()->to('/auth/formLogin');
            }
        } else {
            // Jika nik tidak ditemukan, tampilkan pesan error
            session()->setFlashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Nik belum terdaftar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('/auth/formLogin');
        }
    }


    // Method fungsi untuk registrasi
    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            // Aturan validasi untuk input nik, password, dan level
            $rules = [
                'nik' => [
                    'rules' => 'required|is_unique[tb_users.nik]',
                    'errors' => [
                        'required' => 'NIK tidak boleh kosong',
                        'is_unique' => 'NIK sudah terdaftar',
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong',
                        'min_length' => 'Password minimal 6 karakter',
                    ],
                ],
                'level' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Level tidak boleh kosong',
                    ],
                ],
            ];

            // Memanggil library validasi
            if (!$this->validate($rules)) {
                return view('auth/v_registrasi', [
                    'title' => 'Form Registrasi',
                    'validation' => $this->validator,
                ]);
            }

            // Mengambil data dari database
            $data = [
                'nik' => $this->request->getVar('nik'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getVar('level'),
            ];

            if ($this->model->insert($data)) {
                // Notifikasi ketika data berhasil di daftarkan
                session()->setFlashdata('success', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil didaftar.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                return redirect()->to('/auth/register');
            } else {
                // Notifikasi ketika data gagal di daftarkan
                session()->setFlashdata('error', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data gagal didaftar.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                return redirect()->to('/auth/register');
            }
        }

        $data = [
            'title' => 'Form Registrasi',
        ];

        // Menampilkan halaman view register
        return view('auth/v_registrasi', $data);
    }


    // Method fungsi untuk logout
    public function logout()
    {
        // Hapus session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/');
    }
}
