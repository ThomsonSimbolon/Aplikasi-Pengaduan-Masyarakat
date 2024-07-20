<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Pribadi</h3>
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
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title text-primary">Data Pertanyaan</h3>
                            <a href="<?= base_url('lurah/pertanyaan'); ?>" class="text-danger"><i
                                    class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>

                    <!-- Notifikasi berhasil tambah berita -->
                    <?php if (session('success')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="border: none; outline: none; box-shadow: none;">
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="border: none; outline: none; box-shadow: none;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3 mt-0 d-flex justify-content-end">
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" id="tableSearch"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="example1"
                                class="table table-bordered table-striped table-hover table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>NIK</th>
                                        <th>Kategori Pertanyaan</th>
                                        <th>Tanggal Pertanyaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($l as $lap) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $lap->id_user ?></td>
                                        <td><?= $lap->nik ?></td>
                                        <td><?= $lap->kategori_pertanyaan ?></td>
                                        <td><?= $lap->tgl_pertanyaan ?></td>
                                        <td>
                                            <a href="<?= site_url('lurah/pertanyaan/detail/' . $lap->id_pertanyaan); ?>"
                                                class="btn btn-primary btn-sm shadow"><i class="fas fa-eye"></i>
                                                Detail</a>
                                            <a href="<?= site_url('lurah/pertanyaan/edit/' . $lap->id_pertanyaan); ?>"
                                                class="btn btn-warning btn-sm shadow"><i class="fas fa-edit"></i>
                                                Edit</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>