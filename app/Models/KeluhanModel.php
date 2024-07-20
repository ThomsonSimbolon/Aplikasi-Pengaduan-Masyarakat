<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluhanModel extends Model
{
    protected $table            = 'tb_keluhan';
    protected $primaryKey       = 'id_keluhan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nik', 'nama_pengadu', 'rt_rw', 'kelurahan', 'kecamatan', 'kabupaten', 'no_telp', 'judul_keluh', 'deskripsi_keluh', 'tgl_pengadu', 'tgl_update', 'status', 'file_path', 'kategori_keluh', 'solusi_keluh'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_pengadu';
    protected $updatedField  = 'tgl_update';


    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Update data keluhan
    public function updateKeluhan($id, $data)
    {
        return $this->db->table('tb_keluhan')
            ->where('id_keluhan', $id)
            ->update($data);
    }

    // Fungsi untuk mengambil seluruh data keluhan yang ada di database
    public function countKeluhan()
    {
        return $this->countAll();
    }

    // Fungsi untuk menghitung data materi berdasarkan bulan
    public function getMonthlyCounts()
    {
        return $this->select('MONTH(tgl_pengadu) as month, COUNT(*) as count')
            ->groupBy('MONTH(tgl_pengadu)')
            ->get()
            ->getResultArray();
    }
}
