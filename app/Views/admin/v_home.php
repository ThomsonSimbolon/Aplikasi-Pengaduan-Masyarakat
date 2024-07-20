<?= $this->extend('template/templates_admin/index'); ?>

<?= $this->section('content-admin'); ?>

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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $total_users; ?></h3>

                        <p>Pengguna</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="<?= base_url('admin/pengguna'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $total_keluhan; ?></h3>

                        <p>Keluhan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <a href="<?= base_url('admin/keluhan'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $total_laporan; ?></h3>

                        <p>Laporan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file"></i>
                    </div>
                    <a href="<?= base_url('admin/laporan'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $total_aspirasi; ?></h3>

                        <p>Aspirasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <a href="<?= base_url('admin/aspirasi'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Sales
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                        </h3>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

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
                                            <a href="<?= site_url('admin/home/masyarakat/' . $m['id_masyarakat']); ?>" class="btn btn-info btn-sm shadow"><i class="fas fa-eye"></i>
                                                Lihat</a>
                                            <a href="<?= site_url('admin/home/masyarakat/edit/' . $m['id_masyarakat']); ?>" class="btn btn-warning btn-sm shadow"><i class="fas fa-edit"></i>
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
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script src="<?= base_url(); ?>/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery -->
<script src="<?= base_url(); ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data from PHP controller
        var keluhanData = <?= $keluhan ?>;
        var laporanData = <?= $laporan ?>;
        var aspirasiData = <?= $aspirasi ?>;

        // Setup Line chart (Revenue Chart)
        var ctx1 = document.getElementById('revenue-chart-canvas').getContext('2d');
        var revenueChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ],
                datasets: [{
                        label: 'Keluhan',
                        data: keluhanData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Laporan',
                        data: laporanData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Aspirasi',
                        data: aspirasiData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Setup Doughnut chart (Sales Chart)
        var ctx2 = document.getElementById('sales-chart-canvas').getContext('2d');
        var salesChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Keluhan', 'Laporan', 'Aspirasi'],
                datasets: [{
                    label: 'Jumlah',
                    data: [
                        keluhanData.reduce((a, b) => a + b, 0),
                        laporanData.reduce((a, b) => a + b, 0),
                        aspirasiData.reduce((a, b) => a + b, 0)
                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>

<?= $this->endSection(); ?>