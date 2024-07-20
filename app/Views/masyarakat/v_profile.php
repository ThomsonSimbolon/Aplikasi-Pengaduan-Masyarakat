<?= $this->extend('template/templates_masyarakat/index'); ?>


<?= $this->section('content-masyarakat'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profle</h1>
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
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Card untuk halamana profile masyarakat -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title text-primary">Data Profile</h3>
                            <a href="<?= base_url('masyarakat/home'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>

                    <!-- Notifikasi berhasil tambah profile -->
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border: none; outline: none; box-shadow: none;">
                            <?= session('success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Notifikasi gagal tambah profile -->
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
                        <div class="row">
                            <?php if (!empty($profile)) : ?>
                                <div class="col-md-5 d-flex flex-column align-items-center my-auto">
                                    <?php if ($profile['foto_profile']) : ?>
                                        <img src="<?= base_url('uploads/profile/' . $profile['foto_profile']) ?>" class="img-fluid mb-2 rounded-circle shadow p-2" style="max-width: 300px !important; width: 100% !important; max-height: 300px !important; height: 100% !important; object-fit: cover; position: relative;" alt="User profile picture">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/custom-css/img/default_profile.jpg') ?>" class="img-fluid mb-2" alt="User profile picture">
                                    <?php endif; ?>
                                    <a href="<?= base_url('masyarakat/profile/edit/' . $profile['id_masyarakat']); ?>" class="btn btn-sm btn-primary shadow"><i class="fas fa-edit"></i> Edit
                                        Profile</a>
                                </div>

                                <div class="col-md-7">
                                    <h3 class="profile-username text-center"><?= $profile['nama_lengkap']; ?></h3>
                                    <p class="text-muted text-center"></p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>ID</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['id_user']); ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>No. KTP</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['nik']); ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>RT/RW</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['rt_rw']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Kelurahan</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['kelurahan']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Kecamatan</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['kecamatan']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Kabupaten</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['kabupaten']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Agama</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['agama']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>No. HP</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['no_telp']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Tanggal Lahir</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= $profile['tgl_lahir']; ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Jenis Kelamin</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['jenis_kelamin']); ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Status</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['status']); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Pekerjaan</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($profile['pekerjaan']); ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>