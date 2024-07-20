<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="<?= base_url('lurah/keluhan/data-pribadi'); ?>" class="btn btn-success btn-sm shadow m-0"><i class="fas fa-person"></i> Data Pribadi</a>
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
                            <h3 class="card-title text-primary">Data Keluhan</h3>
                            <a href="<?= base_url('lurah/home'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>

                    <!-- Notifikasi berhasil tambah keluhan -->
                    <?php if (session('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border: none; outline: none; box-shadow: none;">
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; outline: none; box-shadow: none;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3 mt-0 d-flex justify-content-between">
                            <a href="<?= base_url('lurah/keluhan/add'); ?>" class="btn btn-primary btn-sm shadow">Tambah</a>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" id="tableSearch" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nik</th>
                                        <th>Nama Lengkap</th>
                                        <th>RT/RW</th>
                                        <th>No Telp</th>
                                        <th>Judul Keluhan</th>
                                        <th>Tanggal Pengadu</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($keluhan as $key => $value) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $value->id_user; ?></td>
                                            <td><?= $value->nik; ?></td>
                                            <td><?= $value->nama_pengadu; ?></td>
                                            <td><?= $value->rt_rw; ?></td>
                                            <td><?= $value->no_telp; ?></td>
                                            <td><?= $value->judul_keluh; ?></td>
                                            <td><?= $value->tgl_pengadu; ?></td>
                                            <td>
                                                <?php if ($value->status == 'Selesai') : ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('lurah/keluhan/detail/' . $value->id_keluhan); ?>" class="btn btn-primary btn-sm shadow"><i class="fas fa-eye"></i>
                                                    Lihat</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>