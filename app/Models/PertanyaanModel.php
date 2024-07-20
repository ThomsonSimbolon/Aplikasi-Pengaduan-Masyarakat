<?php

namespace App\Models;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table            = 'tb_pertanyaan';
    protected $primaryKey       = 'id_pertanyaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nik', 'kategori_pertanyaan', 'deskripsi', 'tgl_pertanyaan', 'tgl_update', 'file_path'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_pertanyaan';
    protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }


    // Mengupdate data pertanyaan
    public function updatePertanyaan($id, $data)
    {
        $this->set($data);
        $this->where('id_pertanyaan', $id);
        return $this->update();
    }

    // Fungsi untuk mengambil seluruh data pertanyaan yang ada di database
    public function countPertanyaan()
    {
        return $this->countAll();
    }
}
