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
</head>

<body style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100vh;">
    <div class="container-fluid section-regis">
        <div class="card shadow">
            <div class="card-body">
                <form action="<?= site_url('/auth/register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('assets/custom-css/img/logo_pengaduan.png'); ?>" class="img-fluid" style="width: 50px;" alt="Logo Pengaduan">
                            <h4 class="card-title text-dark my-0 text-lg-center">Registrasi</h4>
                        </div>
                    </div>
                    <hr>

                    <!-- Notifikasi berhasil atau gagal -->
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>
                    <!-- End Notifikasi berhasil atau gagal -->

                    <div class="form-group">
                        <label for="nik">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="nik" class="form-control <?= isset($validation) && $validation->hasError('nik') ? 'is-invalid' : ''; ?>" value="<?= old('nik'); ?>" placeholder="Masukkan Nik.." autofocus>
                        <?php if (isset($validation) && $validation->hasError('nik')) : ?>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Password..">
                        <?php if (isset($validation) && $validation->hasError('password')) : ?>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="level">Level <span class="text-danger">*</span></label>
                        <select name="level" id="level" class="form-control <?= isset($validation) && $validation->hasError('level') ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>-- Pilih Role --</option>
                            <option value="masyarakat" <?= old('level') == 'masyarakat' ? 'selected' : ''; ?>>Masyarakat
                            </option>
                        </select>
                        <?php if (isset($validation) && $validation->hasError('level')) : ?>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('level'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-dark text-white shadow w-100">Daftar</button>
                </form>
                <hr>
                <p class="my-0 text-lg-center text-gray-600">
                    Sudah punya akun?
                    <a href="/auth/formLogin" class="font-weight-normal">
                        Login</a>
                </p>
                <p class="text-center my-0 text-gray-600">
                    <a href="<?= site_url('/'); ?>" class="p-footer font-weight-normal text-decoration-none">
                        <i class="fas fa-home"></i> Home</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Script untuk mengkoneksikan bootstrap -->
    <script src="<?= base_url(); ?>/assets/jquery/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="<?= base_url(); ?>/assets/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script>
        // Script untuk menampilkan password
        document
            .getElementById("showPasswordCheck")
            .addEventListener("change", function() {
                var passwordInput = document.getElementById("password");
                if (this.checked) {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });
        // End script untuk menampilkan password
    </script>

</body>

</html>