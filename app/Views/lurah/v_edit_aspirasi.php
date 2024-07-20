<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Aspirasi</h1>
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
                                    <h4 class="card-title my-0 text-primary">Edit Aspirasi</h4>
                                    <a href="<?= base_url('lurah/aspirasi'); ?>" class="text-danger"><i
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
                                <form action="<?= site_url('lurah/aspirasi/update/' . $aspirasi->id_aspirasi); ?>"
                                    method="post" enctype="multipart/form-data">
                                    <?php csrf_field() ?>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?= old('nik', $aspirasi->nik); ?>" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_aspirasi">Judul aspirasi</label>
                                        <input type="text" class="form-control" id="kategori_aspirasi"
                                            name="kategori_aspirasi"
                                            value="<?= old('kategori_aspirasi', $aspirasi->kategori_aspirasi); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"
                                            rows="5"><?= old('deskripsi', $aspirasi->deskripsi); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="rt_rw">RT/RW</label>
                                        <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                            value="<?= old('rt_rw', $aspirasi->rt_rw); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                            value="<?= old('kelurahan', $aspirasi->kelurahan); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            value="<?= old('kecamatan', $aspirasi->kecamatan); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                            value="<?= old('kabupaten', $aspirasi->kabupaten); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lampiran">Lampiran</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="lampiran" name="lampiran"
                                                value="<?= old('lampiran', $aspirasi->lampiran); ?>">
                                            <label class="custom-file-label"
                                                for="lampiran"><?= $aspirasi->lampiran; ?></label>
                                            <?php if ($aspirasi->lampiran) : ?>
                                            <div class="mt-2">
                                                File saat ini: <?= $aspirasi->lampiran; ?>
                                            </div>
                                            <?php endif; ?>
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