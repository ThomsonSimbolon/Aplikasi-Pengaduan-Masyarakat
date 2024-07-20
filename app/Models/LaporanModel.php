<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'tb_laporan';
    protected $primaryKey       = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nik', 'judul_laporan', 'deskripsi', 'tgl_laporan', 'tgl_update', 'rt_rw', 'kecamatan', 'kelurahan', 'kabupaten', 'lampiran', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_laporan';
    protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Update data laporan
    public function updateLaporan($id, $data)
    {
        return $this->db->table('tb_laporan')
            ->where('id_laporan', $id)
            ->update($data);
    }

    // Fungsi untuk mengambil seluruh data laporan yang ada di database
    public function countLaporan()
    {
        return $this->countAll();
    }

    // Fungsi untuk menghitung data materi berdasarkan bulan
    public function getMonthlyCounts()
    {
        return $this->select('MONTH(tgl_laporan) as month, COUNT(*) as count')
            ->groupBy('MONTH(tgl_laporan)')
            ->get()
            ->getResultArray();
    }
}
