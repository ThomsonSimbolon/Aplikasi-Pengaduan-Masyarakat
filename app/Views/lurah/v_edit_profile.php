<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
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
                                    <h4 class="card-title my-0 text-primary">Edit Profile</h4>
                                    <a href="<?= base_url('lurah/profile'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>

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
                            <!-- /.card-header -->
                            <div class="card-body">

                                <form action="<?= site_url('lurah/profile/update/' . $lurah['id_lurah']); ?>"
                                    method="post" enctype="multipart/form-data">
                                    <?php csrf_field() ?>
                                    <input type="hidden" id="id_lurah" name="id_lurah"
                                        value="<?= $lurah['id_lurah']; ?>">
                                    <div class="form-group">
                                        <label for="id_user">ID</label>
                                        <input type="text" class="form-control" id="id_user" name="id_user"
                                            value="<?= old('id_user', $lurah['id_user']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : null ?>"
                                            id="nama_lengkap" name="nama_lengkap"
                                            value="<?= old('nama_lengkap', $lurah['nama_lengkap']); ?>">

                                        <?php if (session('errors.nama_lengkap')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.nama_lengkap') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.nik') ? 'is-invalid' : null ?>"
                                            id="nik" name="nik" value="<?= old('nik', $lurah['nik']); ?>">

                                        <?php if (session('errors.nik')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.nik') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.alamat') ? 'is-invalid' : null ?>"
                                            id="alamat" name="alamat" value="<?= old('alamat', $lurah['alamat']); ?>">

                                        <?php if (session('errors.alamat')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.alamat') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.agama') ? 'is-invalid' : null ?>"
                                            id="agama" name="agama" value="<?= old('agama', $lurah['agama']); ?>">

                                        <?php if (session('errors.agama')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.agama') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.no_telp') ? 'is-invalid' : null ?>"
                                            id="no_telp" name="no_telp"
                                            value="<?= old('no_telp', $lurah['no_telp']); ?>">

                                        <?php if (session('errors.no_telp')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.no_telp') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control <?= session('errors.email') ? 'is-invalid' : null ?>"
                                            id="email" name="email" value="<?= old('email', $lurah['email']); ?>">

                                        <?php if (session('errors.email')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text"
                                            class="form-control <?= session('errors.jabatan') ? 'is-invalid' : null ?>"
                                            id="jabatan" name="jabatan"
                                            value="<?= old('jabatan', $lurah['jabatan']); ?>">

                                        <?php if (session('errors.jabatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.jabatan') ?>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_profile">Foto Profile</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_profile"
                                                name="foto_profile">
                                            <label class="custom-file-label"
                                                for="foto_profile"><?= $lurah['foto_profile'] ?: 'Choose file'; ?></label>
                                            <?php if ($lurah['foto_profile']) : ?>
                                            <div class="mt-2">
                                                File saat ini: <?= $lurah['foto_profile']; ?>
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