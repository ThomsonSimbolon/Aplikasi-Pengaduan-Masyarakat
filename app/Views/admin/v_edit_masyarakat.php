<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Laporan</h1>
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
                                    <a href="<?= base_url('masyarakat/profile'); ?>" class="text-danger"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>

                            <!-- Notifikasi gagal tambah berita -->
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

                                <form action="<?= site_url('admin/home/masyarakat/update/' . $masyarakat['id_masyarakat']); ?>" method="post" enctype="multipart/form-data">
                                    <?php csrf_field() ?>
                                    <input type="hidden" id="id_masyarakat" name="id_masyarakat" value="<?= $masyarakat['id_masyarakat']; ?>">
                                    <div class="form-group">
                                        <label for="id_user">ID</label>
                                        <input type="text" class="form-control" id="id_user" name="id_user" value="<?= old('id_user', $masyarakat['id_user']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : null ?>" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $masyarakat['nama_lengkap']); ?>">

                                        <?php if (session('errors.nama_lengkap')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nama_lengkap') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : null ?>" id="nik" name="nik" value="<?= old('nik', $masyarakat['nik']); ?>">

                                        <?php if (session('errors.nik')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nik') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="rt_rw">RT/RW</label>
                                        <input type="text" class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : null ?>" id="rt_rw" name="rt_rw" value="<?= old('rt_rw', $masyarakat['rt_rw']); ?>">

                                        <?php if (session('errors.rt_rw')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.rt_rw') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" class="form-control <?= session('errors.kelurahan') ? 'is-invalid' : null ?>" id="kelurahan" name="kelurahan" value="<?= old('kelurahan', $masyarakat['kelurahan']); ?>">

                                        <?php if (session('errors.kelurahan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kelurahan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : null ?>" id="kecamatan" name="kecamatan" value="<?= old('kecamatan', $masyarakat['kecamatan']); ?>">

                                        <?php if (session('errors.kecamatan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kecamatan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : null ?>" id="kabupaten" name="kabupaten" value="<?= old('kabupaten', $masyarakat['kabupaten']); ?>">

                                        <?php if (session('errors.kabupaten')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.kabupaten') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text" class="form-control <?= session('errors.agama') ? 'is-invalid' : null ?>" id="agama" name="agama" value="<?= old('agama', $masyarakat['agama']); ?>">

                                        <?php if (session('errors.agama')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.agama') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text" class="form-control <?= session('errors.no_telp') ? 'is-invalid' : null ?>" id="no_telp" name="no_telp" value="<?= old('no_telp', $masyarakat['no_telp']); ?>">

                                        <?php if (session('errors.no_telp')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.no_telp') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control <?= session('errors.tgl_lahir') ? 'is-invalid' : null ?>" id="tgl_lahir" name="tgl_lahir" value="<?= old('tgl_lahir', $masyarakat['tgl_lahir']); ?>">

                                        <?php if (session('errors.tgl_lahir')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tgl_lahir') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : null ?>">
                                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki" <?= $masyarakat['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>
                                                Laki-laki</option>
                                            <option value="Perempuan" <?= $masyarakat['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>
                                                Perempuan</option>
                                        </select>

                                        <?php if (session('errors.jenis_kelamin')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.jenis_kelamin') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control <?= session('errors.status') ? 'is-invalid' : null ?>">
                                            <option value="" selected disabled>-- Pilih Status --
                                            </option>
                                            <option value="Kawin" <?= $masyarakat['status'] == 'Kawin' ? 'selected' : '' ?>>
                                                Kawin</option>
                                            <option value="Belum Kawin" <?= $masyarakat['status'] == 'Belum Kawin' ? 'selected' : '' ?>>
                                                Belum Kawin</option>
                                        </select>

                                        <?php if (session('errors.status')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.status') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control <?= session('errors.pekerjaan') ? 'is-invalid' : null ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $masyarakat['pekerjaan']); ?>">

                                        <?php if (session('errors.pekerjaan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.pekerjaan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_profile">Foto Profile</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_profile" name="foto_profile">
                                            <label class="custom-file-label" for="foto_profile"><?= $masyarakat['foto_profile'] ?: 'Choose file'; ?></label>
                                            <?php if ($masyarakat['foto_profile']) : ?>
                                                <div class="mt-2">
                                                    File saat ini: <?= $masyarakat['foto_profile']; ?>
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