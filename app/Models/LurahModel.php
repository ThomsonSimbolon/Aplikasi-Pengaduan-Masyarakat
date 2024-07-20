<?php

namespace App\Models;

use CodeIgniter\Model;

class LurahModel extends Model
{
    protected $table            = 'tb_lurah';
    protected $primaryKey       = 'id_lurah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nama_lengkap', 'nik', 'alamat', 'agama', 'no_telp', 'email', 'jabatan', 'foto_profile'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    // protected $createdField  = 'tgl_lurah';
    // protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Fungsi untuk mengambil seluruh data lurah yang ada di database
    public function getAllLurah()
    {
        return $this->select('tb_lurah.*, tb_users.*')
            ->join('tb_users', 'tb_users.id_user = tb_lurah.id_user', 'inner')
            ->get()
            ->getResultArray();
    }

    public function getProfile($id_user)
    {
        return $this->select('tb_lurah.*, tb_users.*')
            ->join('tb_users', 'tb_users.id_user = tb_lurah.id_user', 'inner')
            ->where('tb_lurah.id_user', $id_user)
            ->get()
            ->getRowArray();
    }


    // Mengupdate data lurah
    public function updateLurah($id, $data)
    {
        $this->set($data);
        $this->where('id_lurah', $id);
        return $this->update();
    }

    // Fungsi untuk mengambil seluruh data lurah yang ada di database
    public function countLurah()
    {
        return $this->countAll();
    }
}
