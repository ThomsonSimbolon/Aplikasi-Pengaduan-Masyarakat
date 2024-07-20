<?php

namespace App\Models;

use CodeIgniter\Model;

class AspirasiModel extends Model
{
    protected $table            = 'tb_aspirasi';
    protected $primaryKey       = 'id_aspirasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nik', 'kategori_aspirasi', 'deskripsi', 'rt_rw', 'kelurahan', 'kecamatan', 'kabupaten', 'tgl_aspirasi', 'tgl_update', 'lampiran', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_aspirasi';
    protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Fungsi untuk mengambil seluruh data aspirasi yang ada di database
    public function countAspirasi()
    {
        return $this->countAll();
    }

    // Fungsi untuk menghitung data materi berdasarkan bulan
    public function getMonthlyCounts()
    {
        return $this->select('MONTH(tgl_aspirasi) as month, COUNT(*) as count')
            ->groupBy('MONTH(tgl_aspirasi)')
            ->get()
            ->getResultArray();
    }
}
