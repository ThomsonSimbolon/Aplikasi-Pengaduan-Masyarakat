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
                                    <h4 class="card-title my-0 text-primary">Tambah Keluhan</h4>
                                    <a href="<?= base_url('lurah/keluhan'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>

                            <!-- Notifikasi berhasil tambah keluhan -->
                            <?php if (session('success')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                style="border: none; outline: none; box-shadow: none;">
                                <?= session('success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>

                            <!-- Notifikasi gagal tambah keluhan -->
                            <?php if (session('failed')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session('failed'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="border: none; outline: none; box-shadow: none;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?= site_url('lurah/keluhan/create'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <?php csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.nik') ? 'is-invalid' : null ?>"
                                            id="nik" name="nik" value="<?= old('nik'); ?>" placeholder="Masukkan nik..."
                                            autofocus>

                                        <?php if (session('errors.nik')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.nik') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengadu">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.nama_pengadu') ? 'is-invalid' : null ?>"
                                            id="nama_pengadu" name="nama_pengadu" value="<?= old('nama_pengadu'); ?>"
                                            placeholder="Masukkan nama lengkap...">

                                        <?php if (session('errors.nama_pengadu')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.nama_pengadu') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="rt_rw">RT/RW</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : null ?>"
                                            id="rt_rw" name="rt_rw" value="<?= old('rt_rw'); ?>"
                                            placeholder="Masukkan Rt/Rw...">

                                        <?php if (session('errors.rt_rw')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.rt_rw') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.kelurahan') ? 'is-invalid' : null ?>"
                                            id="kelurahan" name="kelurahan" value="<?= old('kelurahan'); ?>"
                                            placeholder="Masukkan Kelurahan...">

                                        <?php if (session('errors.kelurahan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kelurahan') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : null ?>"
                                            id="kecamatan" name="kecamatan" value="<?= old('rt_rw'); ?>"
                                            placeholder="Masukkan Kecamatan...">

                                        <?php if (session('errors.kecamatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kecamatan') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : null ?>"
                                            id="kabupaten" name="kabupaten" value="<?= old('kabupaten'); ?>"
                                            placeholder="Masukkan Kabupaten...">

                                        <?php if (session('errors.kabupaten')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kabupaten') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.no_telp') ? 'is-invalid' : null ?>"
                                            id="no_telp" name="no_telp" value="<?= old('no_telp'); ?>"
                                            placeholder="Masukkan no telp...">

                                        <?php if (session('errors.no_telp')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.no_telp') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_keluh">Judul Keluhan</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.judul_keluh') ? 'is-invalid' : null ?>"
                                            id="judul_keluh" name="judul_keluh" value="<?= old('judul_keluh'); ?>"
                                            placeholder="Masukkan judul keluhan...">

                                        <?php if (session('errors.judul_keluh')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.judul_keluh') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_keluh">Deskripsi</label>
                                        <textarea type="text"
                                            class="form-control <?= session('errors.deskripsi_keluh') ? 'is-invalid' : null ?>"
                                            id="deskripsi_keluh" name="deskripsi_keluh" rows="5"
                                            placeholder="Masukkan deskripsi..."><?= old('deskripsi_keluh'); ?></textarea>

                                        <?php if (session('errors.deskripsi_keluh')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.deskripsi_keluh') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_path">File</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input <?= session('errors.file_path') ? 'is-invalid' : null ?>"
                                                id="file_path" name="file_path">
                                            <label class="custom-file-label" for="file_path">Choose file</label>

                                            <?php if (session('errors.file_path')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.file_path') ?>
                                            </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_keluh">Kategori Keluhan</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.kategori_keluh') ? 'is-invalid' : null ?>"
                                            id="kategori_keluh" name="kategori_keluh"
                                            value="<?= old('kategori_keluh'); ?>"
                                            placeholder="Masukkan kategori keluhan...">

                                        <?php if (session('errors.kategori_keluh')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kategori_keluh') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="solusi_keluh">Solusi</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.solusi_keluh') ? 'is-invalid' : null ?>"
                                            id="solusi_keluh" name="solusi_keluh" value="<?= old('solusi_keluh'); ?>"
                                            placeholder="Masukkan solusi...">

                                        <?php if (session('errors.solusi_keluh')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.solusi_keluh') ?>
                                        </div>
                                        <?php endif ?>
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