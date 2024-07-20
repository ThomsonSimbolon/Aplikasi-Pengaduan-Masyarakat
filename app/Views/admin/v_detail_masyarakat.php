<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Masyarakat</h1>
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
                                    <h4 class="card-title my-0 text-primary">Detail Data Masyarakat</h4>
                                    <a href="<?= base_url('admin/home'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php csrf_field() ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md">
                                        <div class="form-group">
                                            <label for="id_user">ID</label>
                                            <input type="text" class="form-control" id="id_user" name="id_user"
                                                value="<?= old('id_user', $masyarakat['id_user']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap"
                                                name="nama_lengkap"
                                                value="<?= old('nama_lengkap', $masyarakat['nama_lengkap']); ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                value="<?= old('nik', $masyarakat['nik']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="rt_rw">RT/RW</label>
                                            <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                                value="<?= old('rt_rw', $masyarakat['rt_rw']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan">Kelurahan</label>
                                            <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                                value="<?= old('kelurahan', $masyarakat['kelurahan']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                                value="<?= old('kecamatan', $masyarakat['kecamatan']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten">Kabupaten</label>
                                            <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                                value="<?= old('kabupaten', $masyarakat['kabupaten']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama"
                                                value="<?= old('agama', $masyarakat['agama']); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md">
                                        <div class="form-group">
                                            <label for="no_telp">No Telp</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                value="<?= old('no_telp', $masyarakat['no_telp']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal lahir</label>
                                            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                value="<?= old('tgl_lahir', $masyarakat['tgl_lahir']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="jenis_kelamin"
                                                name="jenis_kelamin"
                                                value="<?= old('jenis_kelamin', $masyarakat['jenis_kelamin']); ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" id="status" name="status"
                                                value="<?= old('status', $masyarakat['status']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                value="<?= old('pekerjaan', $masyarakat['pekerjaan']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_profile">Foto Profile</label>
                                            <div class="mt-0">
                                                <img src="<?= base_url('uploads/profile/' . $masyarakat['foto_profile']); ?>"
                                                    class="img-fluid rounded shadow" alt="Foto Profile"
                                                    style="max-width: 120px !important; width: 100% !important; max-height: 120px !important; height: 100% !important;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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