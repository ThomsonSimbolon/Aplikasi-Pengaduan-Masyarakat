<?= $this->extend('template/templates_masyarakat/index'); ?>


<?= $this->section('content-masyarakat'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pertanyaan</h1>
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
                                    <h4 class="card-title my-0 text-primary">Edit Pertanyaan</h4>
                                    <a href="<?= base_url('masyarakat/pertanyaan'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->

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
                            <div class="card-body">
                                <form
                                    action="<?= site_url('masyarakat/pertanyaan/update/' . $pertanyaan->id_pertanyaan); ?>"
                                    method="post" enctype="multipart/form-data">
                                    <?php csrf_field() ?>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?= old('nik', $pertanyaan->nik); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_pertanyaan">Kategori Pertanyaan</label>
                                        <input type="text" class="form-control" id="kategori_pertanyaan"
                                            name="kategori_pertanyaan"
                                            value="<?= old('kategori_pertanyaan', $pertanyaan->kategori_pertanyaan); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"
                                            rows="5"><?= old('deskripsi', $pertanyaan->deskripsi); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_path">File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_path"
                                                name="file_path">
                                            <label class="custom-file-label"
                                                for="file_path"><?= $pertanyaan->file_path ?: 'Choose file'; ?></label>
                                            <?php if ($pertanyaan->file_path) : ?>
                                            <div class="mt-2">
                                                File saat ini: <?= $pertanyaan->file_path; ?>
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