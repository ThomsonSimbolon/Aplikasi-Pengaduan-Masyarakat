<?= $this->extend('template/templates_lurah/index'); ?>


<?= $this->section('content-lurah'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Aspirasi</h1>
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
                                    <h4 class="card-title my-0 text-primary">Detail Aspirasi</h4>
                                    <a href="<?= base_url('lurah/aspirasi'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php csrf_field() ?>
                                <div class="form-group">
                                    <label for="kategori_aspirasi">Judul aspirasi</label>
                                    <input type="text" class="form-control" id="kategori_aspirasi"
                                        name="kategori_aspirasi"
                                        value="<?= old('kategori_aspirasi', $aspirasi->kategori_aspirasi); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                        readonly><?= old('deskripsi', $aspirasi->deskripsi); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rt_rw">RT/RW</label>
                                    <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                        value="<?= old('rt_rw', $aspirasi->rt_rw); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                        value="<?= old('kelurahan', $aspirasi->kelurahan); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        value="<?= old('kecamatan', $aspirasi->kecamatan); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                        value="<?= old('kabupaten', $aspirasi->kabupaten); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="lampiran">Lampiran</label>
                                    <p>Nama File: <?= $aspirasi->lampiran; ?></p>
                                    <?php if ($aspirasi->lampiran) : ?>
                                    <div class="container-fluid mt-4 d-flex align-items-center justify-content-center">
                                        <?php
                                            $fileExtension = pathinfo($aspirasi->lampiran, PATHINFO_EXTENSION);
                                            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                        <img src="<?= base_url('/assets/uploads/' . $aspirasi->lampiran); ?>"
                                            class="img-fluid" alt="Lampiran">
                                        <?php elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) : ?>
                                        <video controls class="img-fluid">
                                            <source src="<?= base_url('/assets/uploads/' . $aspirasi->lampiran); ?>"
                                                type="video/<?= $fileExtension; ?>">
                                            Browser kamu tidak support untuk memutar vidio.
                                        </video>
                                        <?php elseif ($fileExtension === 'pdf') : ?>
                                        <embed src="<?= base_url('/assets/uploads/' . $aspirasi->lampiran); ?>"
                                            type="application/pdf" width="100%" height="600px" />
                                        <?php elseif (in_array($fileExtension, ['doc', 'docx'])) : ?>
                                        <a href="<?= base_url('/assets/uploads/' . $aspirasi->lampiran); ?>"
                                            target="_blank">Download Lampiran</a>
                                        <?php else : ?>
                                        <p>Jenis lampiran tidak didukung untuk pratinjau.</p>
                                        <?php endif; ?>
                                    </div>
                                    <?php else : ?>
                                    <p>Tidak ada data lampiran.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                        value="<?= old('status', $aspirasi->status); ?>" readonly>
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