<?php

namespace App\Models;

use CodeIgniter\Model;

class MasyarakatModel extends Model
{
    protected $table            = 'tb_masyarakat';
    protected $primaryKey       = 'id_masyarakat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nama_lengkap', 'nik', 'alamat', 'rt_rw', 'kelurahan', 'kecamatan', 'kabupaten', 'agama', 'no_telp', 'tgl_lahir', 'jenis_kelamin', 'status', 'pekerjaan', 'foto_profile'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    // protected $createdField  = 'tgl_masyarakat';
    // protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Fungsi untuk mengambil seluruh data masyarakat yang ada di database
    public function getAllMasyarakat()
    {
        return $this->select('tb_masyarakat.*, tb_users.*')
            ->join('tb_users', 'tb_users.id_user = tb_masyarakat.id_user', 'inner')
            ->get()
            ->getResultArray();
    }

    public function getProfile($id_user)
    {
        return $this->select('tb_masyarakat.*, tb_users.*')
            ->join('tb_users', 'tb_users.id_user = tb_masyarakat.id_user', 'inner')
            ->where('tb_masyarakat.id_user', $id_user)
            ->get()
            ->getRowArray();
    }


    // Mengupdate data masyarakat
    public function updateMasyarakat($id, $data)
    {
        $this->set($data);
        $this->where('id_masyarakat', $id);
        return $this->update();
    }

    // Fungsi untuk mengambil seluruh data masyarakat yang ada di database
    public function countmasyarakat()
    {
        return $this->countAll();
    }
}
