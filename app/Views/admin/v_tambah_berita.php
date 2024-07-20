<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Berita</h1>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow card-primary card-outline">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-item-center justify-content-between">
                                    <h4 class="card-title my-0 text-primary">Tambah Berita</h4>
                                    <a href="<?= base_url('admin/berita'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- Notifikasi berhasil tambah berita -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border: none; outline: none; box-shadow: none;">
                                    <?= session('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Notifikasi gagal tambah berita -->
                            <?php if (session('failed')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session('failed'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; outline: none; box-shadow: none;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <form action="<?= site_url('admin/berita/create') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control  <?= session('errors.judul') ? 'is-invalid' : null ?>" id="nama_lengkap" name="judul" value="<?= old('judul'); ?>" placeholder="Masukkan judul...">
                                        <?php if (session('errors.judul')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.judul') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="isi">Isi</label>
                                        <textarea class="form-control  <?= session('errors.isi') ? 'is-invalid' : null ?>" id="isi" name="isi" rows="5" placeholder="Masukkan isi..."><?= old('isi'); ?></textarea>
                                        <?php if (session('errors.isi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.isi') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="penulis">Penulis</label>
                                        <input type="text" class="form-control  <?= session('errors.penulis') ? 'is-invalid' : null ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>" placeholder="Masukkan penulis...">
                                        <?php if (session('errors.penulis')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.penulis') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" class="form-control <?= session('errors.url') ? 'is-invalid' : null ?>" id="url" name="url" value="<?= old('url'); ?>" placeholder="Masukkan URL...">
                                        <?php if (session('errors.url')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.url') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="file_path">File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= session('errors.file_path') ? 'is-invalid' : '' ?>" id="file" name="file_path">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                            <?php if (session('errors.file_path')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.file_path') ?>
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
        </div>
    </div>
</section>

<?= $this->endSection(); ?>