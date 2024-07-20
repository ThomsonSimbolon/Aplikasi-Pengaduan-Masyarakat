<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Keluhan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <?php foreach ($breadcrumb as $key => $link) : ?>
                    <?php if ($key === 'Active Page') : ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $link ?></li>
                    <?php else : ?>
                    <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $key ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow card-primary card-outline">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-item-center justify-content-between">
                                    <h4 class="card-title my-0 text-primary">Edit Keluhan</h4>
                                    <a href="<?= base_url('lurah/keluhan'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <!-- Notifikasi gagal tambah berita -->
                            <?php if (session('failed')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session('failed'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="border: none; outline: none; box-shadow: none;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="<?= site_url('lurah/keluhan/update/' . $keluhan->id_keluhan); ?>"
                                    method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?= old('nik', $keluhan->nik); ?>" placeholder="Masukkan nik..."
                                            autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengadu">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_pengadu" name="nama_pengadu"
                                            value="<?= old('nama_pengadu', $keluhan->nama_pengadu); ?>"
                                            placeholder="Masukkan nama lengkap...">
                                    </div>
                                    <div class="form-group">
                                        <label for="rt_rw">RT/RW</label>
                                        <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                            value="<?= old('rt_rw', $keluhan->rt_rw); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                            value="<?= old('kelurahan', $keluhan->kelurahan); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            value="<?= old('kecamatan', $keluhan->kecamatan); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                            value="<?= old('kabupaten', $keluhan->kabupaten); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp"
                                            value="<?= old('no_telp', $keluhan->no_telp); ?>"
                                            placeholder="Masukkan no telp...">
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_keluh">Judul Keluhan</label>
                                        <input type="text" class="form-control" id="judul_keluh" name="judul_keluh"
                                            value="<?= old('judul_keluh', $keluhan->judul_keluh); ?>"
                                            placeholder="Masukkan judul keluhan...">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_keluh">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi_keluh" name="deskripsi_keluh"
                                            rows="5"
                                            placeholder="Masukkan deskripsi..."><?= old('deskripsi_keluh', $keluhan->deskripsi_keluh); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_path">Lampiran</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_path"
                                                name="file_path">
                                            <label class="custom-file-label"
                                                for="file_path"><?= $keluhan->file_path ?: 'Choose file'; ?></label>
                                            <?php if ($keluhan->file_path) : ?>
                                            <div class="mt-2">
                                                File saat ini: <?= $keluhan->file_path; ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_keluh">Kategori Keluhan</label>
                                        <input type="text" class="form-control" id="kategori_keluh"
                                            name="kategori_keluh"
                                            value="<?= old('kategori_keluh', $keluhan->kategori_keluh); ?>"
                                            placeholder="Masukkan kategori keluhan...">
                                    </div>
                                    <div class="form-group">
                                        <label for="solusi_keluh">Solusi</label>
                                        <input type="text" class="form-control" id="solusi_keluh" name="solusi_keluh"
                                            value="<?= old('solusi_keluh', $keluhan->solusi_keluh); ?>"
                                            placeholder="Masukkan solusi...">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>