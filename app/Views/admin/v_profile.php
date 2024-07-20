<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
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
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li> -->
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
        <div class="row  d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title text-primary">Data Profile</h3>
                            <a href="<?= base_url('admin/home'); ?>" class="text-danger"><i
                                    class="fa-solid fa-xmark"></i></a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($admin)) : ?>
                                <div class="col-md-4 d-flex flex-column align-items-center my-auto">
                                    <img src="<?= base_url(); ?>/AdminLTE/dist/img/user2-160x160.jpg"
                                        class="img-fluid rounded-circle w-75 p-2 shadow" alt="Foto Profile">
                                </div>

                                <div class="col-md-7">
                                    <h3 class="profile-username text-center"><?= $admin->nik; ?></h3>
                                    <p class="text-muted text-center"></p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>ID</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($admin->id_user); ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>NIK</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($admin->nik); ?></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Password</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($admin->password); ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-3"><b>Level</b></div>
                                                <div class="col-md-9"><span class="mr-2">:</span>
                                                    <?= esc($admin->level); ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>