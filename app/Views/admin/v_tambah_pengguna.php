<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pengguna</h1>
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
                                    <h4 class="card-title my-0 text-primary">Tambah Pengguna</h4>
                                    <a href="<?= base_url('admin/pengguna'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>

                            <!-- Notifikasi berhasil tambah pengguna -->
                            <?php if (session('success')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border: none; outline: none; box-shadow: none;">
                                    <?= session('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Notifikasi gagal tambah pengguna -->
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
                                <form action="<?= site_url('admin/pengguna/create'); ?>" method="post" enctype="multipart/form-data">
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
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : null ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Masukkan kategori pertanyaan...">

                                        <?php if (session('errors.password')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.password') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="level">Level <span class="text-danger">*</span></label>
                                        <select name="level" id="level" class="form-control <?= session('errors.level') ? 'is-invalid' : null ?>">
                                            <option value="">-- Pilih Role --</option>
                                            <option value="admin" <?= old('level') == 'admin' ? 'selected' : ''; ?>>
                                                Admin
                                            </option>
                                            <option value="lurah" <?= old('level') == 'lurah' ? 'selected' : ''; ?>>
                                                Lurah
                                            </option>
                                            <option value="masyarakat" <?= old('level') == 'masyarakat' ? 'selected' : ''; ?>>Masyarakat
                                            </option>
                                        </select>
                                        <?php if (session('errors.level')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.level') ?>
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