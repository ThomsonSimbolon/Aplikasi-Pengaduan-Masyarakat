<?= $this->extend('template/templates_masyarakat/index'); ?>


<?= $this->section('content-masyarakat'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Berita</h1>
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
    <!-- container fluid -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title text-primary">Data Berita</h4>
                    </div>

                    <!-- Notifikasi berita -->
                    <?php if (session('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session('pesan'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; outline: none; box-shadow: none;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Notifikasi berita -->
                    <?php if (session('hapus')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session('hapus'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; outline: none; box-shadow: none;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
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
                                                <h4 class="card-title mb-1 font-weight-bold" style="text-decoration: underline;"><?= esc($beritaItem->judul); ?>
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>