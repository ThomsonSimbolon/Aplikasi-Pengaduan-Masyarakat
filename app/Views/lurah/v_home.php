<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
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
        <div class="row">
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $total_keluhan; ?></h3>

                        <p>Keluhan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <a href="<?= base_url('lurah/keluhan'); ?>" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $total_laporan; ?></h3>

                        <p>Laporan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file"></i>
                    </div>
                    <a href="<?= base_url('lurah/laporan'); ?>" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $total_aspirasi; ?></h3>

                        <p>Aspirasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <a href="<?= base_url('lurah/aspirasi'); ?>" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $total_pertanyaan; ?></h3>

                        <p>Pertanyaan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <a href="<?= base_url('lurah/pertanyaan'); ?>" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row d-flex justify-content-center">
            <div class="card shadow">
                <div class="card-header bg-transparent d-flex justify-content-center border border-0">
                    <img src="<?= base_url('assets/custom-css/img/logo_pengaduan.png'); ?>" class="img-fluid w-75"
                        alt="Logo Pengaduan">
                </div>
                <div class="card-body border border-0">
                    <div class="text-center">
                        <h5 class="card-text">Selamat datang, <strong><?= $nama_lengkap; ?></strong></h5>
                        <p class="card-text">Berikut adalah halaman utama yang dapat membantu dalam pengaduan <br>
                            lurah dengan layanan pintar di smart village.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Menampilkan Seluruh Data Masyarakat -->
                <div class="card shadow card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-primary">Data Masyarakat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>RT/RW</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Agama</th>
                                    <th>No Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($masyarakat as $m) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $m['id_user']; ?></td>
                                    <td><?= $m['nama_lengkap']; ?></td>
                                    <td><?= $m['nik']; ?></td>
                                    <td><?= $m['rt_rw']; ?></td>
                                    <td><?= $m['kelurahan']; ?></td>
                                    <td><?= $m['kecamatan']; ?></td>
                                    <td><?= $m['kabupaten']; ?></td>
                                    <td><?= $m['agama']; ?></td>
                                    <td><?= $m['no_telp']; ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/home/masyarakat/' . $m['id_masyarakat']); ?>"
                                            class="btn btn-info btn-sm shadow"><i class="fas fa-eye"></i>
                                            Lihat</a>
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
</section>
<!-- /.content -->

<?= $this->endSection(); ?>