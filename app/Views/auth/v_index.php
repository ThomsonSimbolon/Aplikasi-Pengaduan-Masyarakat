<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>

    <!-- Link href untuk mengkoneksikan fontawesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">

    <!-- Link href untuk mengkoneksikan bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/bootstrap/dist/css/bootstrap.min.css">

    <!-- Link href untuk mengkoneksikan ke css eksternal -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/custom-css/css/style.css">

    <!-- Link untuk memanggil favicon css -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/custom-css/img/favicon_pengaduan.png" type="image/x-icon">
    <!-- End Link untuk memanggi favicon css -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
</head>

<body style="height: 100vh;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/auth'); ?>">
                <img src="<?= base_url('assets/custom-css/img/logo_pengaduan.png'); ?>" class="img-fluid" style="width: 50px;" alt="Logo">
                Aplikasi Pengaduan
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item shadow-sm mx-1">
                        <a class="nav-link my-auto text-center btn btn-sm btn-secondary text-light rounded" href="<?= base_url('auth/register'); ?>">Registrasi</a>
                    </li>
                    <li class="nav-item shadow-sm mx-1">
                        <a class="nav-link my-auto text-center text-light btn btn-sm btn-primary rounded" href="<?= base_url('auth/formLogin'); ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Jumbotron -->
    <div class="jumbotron-area">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-transparent border-0">
                            <div class="card-header bg-transparent border-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?= base_url('assets/custom-css/img/logo_pengaduan.png'); ?>" class="img-fluid" style="max-width: 450px !important; width: 100% !important;" alt="Logo">
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-text">Selamat Datang Di Aplikasi Pengaduan Masyarakat <br>
                                    Dengan Layanan Pintar Di Smart Village
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="text-center mb-5">
            <h4 class="text-uppercase" style="text-decoration: underline;">Berita Terkini</h4>
        </div>
        <?php if (isset($berita) && count($berita) > 0) : ?>
            <div class="row">
                <?php foreach ($berita as $beritaItem) : ?>
                    <div class="col-lg-6 mb-5">
                        <div class="d-flex align-items-center">
                            <p class="card-text mb-2"><?= esc($beritaItem->penulis); ?> <i class="fas fa fa-angle-right" style="font-size: 0.8rem;"></i>
                                <a href="<?= esc($beritaItem->url); ?>" target="_blank"><?= esc($beritaItem->judul); ?></a>
                            </p>
                        </div>
                        <div class="card card-berita shadow h-100">
                            <img src="<?= base_url('/assets/uploads/' . $beritaItem->file_path); ?>" class="card-img-top rounded-top w-100" alt="Gambar Berita" style="height: 350px; object-fit: cover;">
                            <div class="card-body">
                                <h4 class="card-title mb-1 font-weight-bold" style="text-decoration: underline;">
                                    <?= esc($beritaItem->judul); ?>
                                </h4>
                                <p class="card-text"><?= esc($beritaItem->isi); ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between my-0">
                                <small class="text-muted"><?= date('d-m-Y H:i:s', strtotime($beritaItem->tgl_publikasi)) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Tidak ada berita yang tersedia.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small bg-light text-dark" style="width: 100%; bottom: 0;">
        <div class="footer-copyright text-center py-3">
            <strong>Copyright &copy; 2024 ~ Aplikasi Sistem Pengaduan Masyarakat</strong>
            All rights reserved
        </div>
    </footer>


    <!-- Script untuk mengkoneksikan bootstrap -->
    <script src="<?= base_url(); ?>/assets/jquery/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="<?= base_url(); ?>/assets/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>