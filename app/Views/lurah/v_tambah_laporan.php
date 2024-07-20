<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Laporan</h1>
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
                                    <h4 class="card-title my-0 text-primary">Tambah Laporan</h4>
                                    <a href="<?= base_url('lurah/laporan'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>

                            <!-- Notifikasi berhasil tambah laporan -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border: none; outline: none; box-shadow: none;">
                                    <?= session('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Notifikasi gagal tambah laporan -->
                            <?php if (session('failed')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session('failed'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; outline: none; box-shadow: none;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?= site_url('lurah/laporan/create'); ?>" method="post" enctype="multipart/form-data">
                                    <?php csrf_field() ?>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : null ?>" id="nik" name="nik" value="<?= old('nik'); ?>" placeholder="Masukkan nik..." autofocus>

                                        <?php if (session('errors.nik')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nik') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_laporan">Judul Laporan</label>
                                        <input type="text" class="form-control <?= session('errors.judul_laporan') ? 'is-invalid' : null ?>" id="judul_laporan" name="judul_laporan" value="<?= old('judul_laporan'); ?>" placeholder="Masukkan judul laporan...">

                                        <?php if (session('errors.judul_laporan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.judul_laporan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea type="text" class="form-control <?= session('errors.deskripsi') ? 'is-invalid' : null ?>" id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan deskripsi..."><?= old('deskripsi'); ?></textarea>

                                        <?php if (session('errors.deskripsi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.deskripsi') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="rt_rw">RT/RW</label>
                                        <input type="text" class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : null ?>" id="rt_rw" name="rt_rw" value="<?= old('rt_rw'); ?>" placeholder="Masukkan rt/rw...">

                                        <?php if (session('errors.rt_rw')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.rt_rw') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : null ?>" id="kecamatan" name="kecamatan" value="<?= old('kecamatan'); ?>" placeholder="Masukkan kecamatan...">

                                        <?php if (session('errors.kecamatan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kecamatan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" class="form-control <?= session('errors.kelurahan') ? 'is-invalid' : null ?>" id="kelurahan" name="kelurahan" value="<?= old('kelurahan'); ?>" placeholder="Masukkan kelurahan...">

                                        <?php if (session('errors.kelurahan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kelurahan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : null ?>" id="kabupaten" name="kelurahan" value="<?= old('kabupaten'); ?>" placeholder="Masukkan kabupaten...">

                                        <?php if (session('errors.kabupaten')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kabupaten') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="lampiran">Lampiran</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= session('errors.lampiran') ? 'is-invalid' : null ?>" id="lampiran" name="lampiran">
                                            <label class="custom-file-label" for="lampiran">Choose file</label>


                                            <?php if (session('errors.lampiran')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.lampiran') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
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