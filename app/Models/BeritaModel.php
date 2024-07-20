<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'tb_berita';
    protected $primaryKey       = 'id_berita';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['judul', 'isi', 'penulis', 'url', 'file_path', 'tgl_publikasi', 'tgl_update'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_publikasi';
    protected $updatedField  = 'tgl_update';

    public function __construct()
    {
        parent::__construct();

        // Set default timezone to 'Asia/Jakarta'
        date_default_timezone_set('Asia/Jakarta');
    }

    // Model fungsi untuk menampilkan semua data yang ada di database
    public function getBeritaAll()
    {
        return $this->findAll();
    }

    // Model fungsi untuk update data forum
    public function updateBerita($id, $data)
    {
        return $this->set($data)->where('id_berita', $id)->update();
    }

    public function getApprovedBerita()
    {
        return $this->where('status', 'published')->findAll();
    }

    public function updateBeritaStatus($id, $status)
    {
        $this->set(['status' => $status])->where('id_berita', $id)->update();
    }

    public function getBeritaByUser($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }

    // Model fungsi untuk delete data forum diskusi
    public function deleteBerita($id)
    {
        return $this->where('id_berita', $id)->delete();
    }
}
