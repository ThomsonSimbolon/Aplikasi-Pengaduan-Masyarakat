<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
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
                                    <h4 class="card-title my-0 text-primary">Detail Pertanyaan</h4>
                                    <a href="<?= base_url('admin/pertanyaan'); ?>" class="text-danger"><i
                                            class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->


                            <!-- Notifikasi berhasil ubah jawaban pertanyaan -->
                            <?php if (session('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session('success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="border: none; outline: none; box-shadow: none;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>

                            <!-- Notifikasi hapus jawaban pertanyaan -->
                            <?php if (session('hapus')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session('hapus'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="border: none; outline: none; box-shadow: none;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>

                            <!-- Notifikasi gagal tambah pertanyaan -->
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
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="kategori_pertanyaan">Kategori Pertanyaan</label>
                                    <input type="text" class="form-control" id="kategori_pertanyaan"
                                        name="kategori_pertanyaan"
                                        value="<?= old('kategori_pertanyaan', $pertanyaan->kategori_pertanyaan); ?>"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                        readonly><?= old('deskripsi', $pertanyaan->deskripsi); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pertanyaan">Tanggal Pertanyaan</label>
                                    <input type="datetime" class="form-control" id="tgl_pertanyaan"
                                        name="tgl_pertanyaan"
                                        value="<?= old('tgl_pertanyaan', $pertanyaan->tgl_pertanyaan); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="file_path">File</label>
                                    <p>Nama File: <?= $pertanyaan->file_path; ?></p>
                                    <?php if ($pertanyaan->file_path) : ?>
                                    <div class="container-fluid mt-4 d-flex align-items-center justify-content-center">
                                        <?php
                                            $fileExtension = pathinfo($pertanyaan->file_path, PATHINFO_EXTENSION);
                                            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                        <img src="<?= base_url('/assets/uploads/' . $pertanyaan->file_path); ?>"
                                            class="img-fluid" alt="Lampiran">
                                        <?php elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) : ?>
                                        <video controls class="img-fluid">
                                            <source src="<?= base_url('/assets/uploads/' . $pertanyaan->file_path); ?>"
                                                type="video/<?= $fileExtension; ?>">
                                            Browser kamu tidak support untuk memutar vidio.
                                        </video>
                                        <?php elseif ($fileExtension === 'pdf') : ?>
                                        <embed src="<?= base_url('/assets/uploads/' . $pertanyaan->file_path); ?>"
                                            type="application/pdf" width="100%" height="600px" />
                                        <?php elseif (in_array($fileExtension, ['doc', 'docx'])) : ?>
                                        <a href="<?= base_url('/assets/uploads/' . $pertanyaan->file_path); ?>"
                                            target="_blank">Download Lampiran</a>
                                        <?php else : ?>
                                        <p>Jenis lampiran tidak didukung untuk pratinjau.</p>
                                        <?php endif; ?>
                                    </div>
                                    <?php else : ?>
                                    <p>Tidak ada data lampiran.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer border border-1 bg-transparent">
                                <!-- Ini adalah form untuk menambahkan data jawaban -->
                                <form action="<?= base_url('admin/pertanyaan/detail/jawaban') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_user" value="<?= session()->get('users_id') ?>">
                                    <input type="hidden" name="id_pertanyaan" value="<?= $pertanyaan->id_pertanyaan ?>">
                                    <div class="form-group">
                                        <label for="jawaban">Jawaban</label>
                                        <textarea name="jawaban" id="jawaban" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm shadow"><i
                                            class="fas fa-paper-plane"></i> Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menampilkan data jawaban -->
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title my-0 text-primary">Jawaban</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (!empty($jawaban)) : ?>
                        <?php foreach ($jawaban as $jawaban) : ?>
                        <div class="mb-2">
                            <p><small class="text-muted"><strong><?= $jawaban->nama_lengkap; ?></strong> -
                                    (<?= date('d-m-Y H:i:s', strtotime($jawaban->tgl_jawaban)); ?>)</small>
                            </p>

                            <p><?= esc($jawaban->jawaban); ?></p>
                        </div>
                        <!-- Bagian untuk menghapus Jawaban -->
                        <a href="<?= site_url('admin/pertanyaan/detail/jawaban/edit/' . $jawaban->id_jawaban); ?>"
                            class="btn btn-warning btn-sm shadow-sm" data-toggle="modal"
                            data-target="#editJawaban<?= $jawaban->id_jawaban ?>"><i
                                class="fas fa-edit icon-Jawaban"></i></a>
                        <a href="<?= site_url('admin/pertanyaan/detail/deleteJawaban/' . $jawaban->id_jawaban); ?>"
                            class="btn btn-danger btn-sm shadow-sm" id="hapusBtn12"><i
                                class="fas fa-trash icon-Jawaban"></i></a>
                        <hr>

                        <!-- Modal -->

                        <div class="modal fade" id="editJawaban<?= $jawaban->id_jawaban ?>" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="editJawabanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary my-0" id="editJawabanLabel">Edit
                                            Jawaban</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="<?= site_url('admin/pertanyaan/detail/jawaban/update/' . $jawaban->id_jawaban); ?>"
                                            method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id_jawaban" id="id_jawaban"
                                                value="<?= $jawaban->id_jawaban; ?>">
                                            <input type="hidden" name="id_pertanyaan"
                                                value="<?= $jawaban->id_pertanyaan; ?>">
                                            <div class="form-group">
                                                <label for="id_pertanyaan">ID Pertanyaan</label>
                                                <input type="text" name="id_pertanyaan" id="id_pertanyaan"
                                                    class="form-control"
                                                    value="<?= old('id_pertanyaan', $jawaban->id_pertanyaan); ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="jawaban">Jawaban</label>
                                                <textarea name="jawaban" id="jawaban" class="form-control"
                                                    required><?= old('jawaban', $jawaban->jawaban); ?></textarea>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="mb-2">
                            <p>Belum ada jawaban.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div> <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>