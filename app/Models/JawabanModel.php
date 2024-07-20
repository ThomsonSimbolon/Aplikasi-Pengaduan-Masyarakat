<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table            = 'tb_jawaban';
    protected $primaryKey       = 'id_jawaban';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_pertanyaan', 'nama_lengkap', 'jawaban', 'tgl_jawaban', 'tgl_update'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_jawaban';
    protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }


    // Model fungsi untuk menampilkan semua data yang ada di database
    public function getAllJawaban()
    {
        return $this->findAll();
    }

    // Model fungsi untuk mengambil data dari pertanyaan
    public function getJawabanByPertanyaan($id)
    {
        return $this->where('id_pertanyaan', $id)->findAll();
    }

    // Model fungsi untuk update data Jawaban
    public function updateJawaban($id_jawaban)
    {
        return $this->where('id_jawaban', $id_jawaban)->update();
    }
}
