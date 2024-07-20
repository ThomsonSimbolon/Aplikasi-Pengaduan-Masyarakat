<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tb_users';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['nik', 'password', 'level'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


    // Mengambil seluruh data user
    // public function getAllUsersData()
    // {
    //     return $this->db->table($this->table)
    //         ->join('tb_dosen', 'tb_dosen.id_user = tb_users.id_user', 'inner')
    //         ->join('tb_pegawai', 'tb_pegawai.id_user = tb_users.id_user', 'inner')
    //         ->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_users.id_user', 'inner')
    //         ->get()
    //         ->getResult();
    // }

    public function getUsers()
    {
        return $this->findAll();
    }
    // public function getUserById($id)
    // {
    //     return $this->find($id);
    // }

    // public function insertUser($data)
    // {
    //     return $this->insert($data);
    // }

    // // Fungsi untuk menampilkan di halaman profile
    // public function getIdProfile($id)
    // {
    //     return $this->where('id_user', $id)->first();
    // }

    // // Fungsi untuk update data profile
    // public function updateProfile($id, $data)
    // {
    //     $this->set($data);
    //     $this->where('id_user', $id);
    //     return $this->update();
    // }

    // public function updateUserStatus($id, $status)
    // {
    //     $this->update($id, ['status' => $status]);
    //     // $this->where('id_user', $id)->update(['status' => $status]);
    // }

    // public function updateUser($id, $data)
    // {
    //     $this->update($id, $data);
    // }

    // public function updateUsers($id_user, $data)
    // {
    //     return $this->db->table('tb_users')
    //         ->where('id_user', $id_user)
    //         ->update($data);
    // }

    // // Fungsinya untuk menghapus user / pengguna
    // public function deleteUser($id)
    // {
    //     return $this->db->table('users')->delete(['id_user' => $id]);
    //     return $this->db->table($this->table)->where(['id_user', $id])->delete();
    // }

    // // Fungsinya untuk menghitung banyaknya user / pengguna
    public function countUsers()
    {
        return $this->countAll();
    }

    // // Metode untuk menyimpan data pengguna ke dalam database
    // public function saveUser($data)
    // {
    //     return $this->save($data);
    // }

    // public function getUserWithDetails($id_user)
    // {
    //     return $this->select('tb_users.*, tb_mahasiswa.*, tb_dosen.*, tb_pegawai.*')
    //         ->join('tb_mahasiswa', 'tb_mahasiswa.id_user = tb_users.id_user', 'left')
    //         ->join('tb_dosen', 'tb_dosen.id_user = tb_users.id_user', 'left')
    //         ->join('tb_pegawai', 'tb_pegawai.id_user = tb_users.id_user', 'left')
    //         ->where('tb_users.id_user', $id_user)
    //         ->first();
    // }
}
