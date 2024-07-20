<?= $this->extend('template/templates_admin/index'); ?>


<?= $this->section('content-admin'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pengguna</h1>
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
                <div class="card shadow card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="card-title text-primary">Data Pengguna</h4>
                            <a href="<?= base_url('admin/home'); ?>" class="text-danger"><i
                                    class="fa-solid fa-xmark"></i></a>
                        </div>
                    </div>

                    <!-- Notifikasi berita -->
                    <?php if (session('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session('pesan'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="border: none; outline: none; box-shadow: none;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <!-- Notifikasi berita -->
                    <?php if (session('hapus')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session('hapus'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="border: none; outline: none; box-shadow: none;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <div class="mb-3 mt-0 d-flex justify-content-between">
                            <button type="button" class="btn btn-primary btn-sm shadow-none" data-toggle="modal"
                                data-target="#tambahBackdrop">
                                Tambah
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahBackdrop" data-backdrop="tambah" data-keyboard="false"
                                tabindex="-1" aria-labelledby="tambahBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahBackdropLabel">Tambah Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= site_url('admin/pengguna/create'); ?>" method="post">
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input type="text" class="form-control" id="nik" name="nik"
                                                        placeholder="Masukkan NIK..">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Masukkan Pasword..">
                                                </div>

                                                <div class="form-group">
                                                    <label for="level">Level</label>
                                                    <select class="form-control" id="level" name="level">
                                                        <option value="">-- Pilih Role --</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="lurah">Lurah</option>
                                                        <option value="masyarakat">Masyarakat</option>
                                                    </select>
                                                </div>
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Keluar</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" id="tableSearch"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped table-hover table-responsive-lg"
                                id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Password</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pengguna as $key => $value) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $value->nik; ?></td>
                                        <td><?= $value->password; ?></td>
                                        <td><?= $value->level; ?></td>
                                        <td>
                                            <a href="" data-toggle="modal"
                                                data-target="#detailBackdrop<?= $value->id_user ?>"
                                                class="btn btn-info btn-sm shadow"><i class="fas fa-eye"></i></a>
                                            <a href="" data-toggle="modal"
                                                data-target="#editBackdrop<?= $value->id_user ?>"
                                                class="btn btn-warning btn-sm shadow"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('admin/pengguna/delete/' . $value->id_user); ?>"
                                                class="btn btn-danger btn-sm shadow"
                                                onclick="return confirm('Apakah anda yakin?');"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <!-- Modal Edit Pengguna -->
                                <?php foreach ($pengguna as $key => $value) : ?>
                                <div class="modal fade" id="editBackdrop<?= $value->id_user ?>" data-backdrop="edit"
                                    data-keyboard="false" tabindex="-1"
                                    aria-labelledby="editBackdropLabel<?= $value->id_user ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBackdropLabel<?= $value->id_user ?>">
                                                    Edit
                                                    Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="<?= site_url('admin/pengguna/update/' . $value->id_user); ?>"
                                                    method="post">
                                                    <input type="hidden" name="id_user" value="<?= $value->id_user; ?>">

                                                    <div class="form-group">
                                                        <label for="nik">NIK</label>
                                                        <input type="text" class="form-control" id="nik" name="nik"
                                                            value="<?= $value->nik; ?>" placeholder="Masukkan NIK..">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="<?= $value->password; ?>"
                                                            placeholder="Masukkan Pasword..">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <select class="form-control" id="level" name="level">
                                                            <option value="">-- Pilih Role --</option>
                                                            <option value="admin"
                                                                <?= $value->level == 'admin' ? 'selected' : null; ?>>
                                                                Admin
                                                            </option>
                                                            <option value="lurah"
                                                                <?= $value->level == 'lurah' ? 'selected' : null; ?>>
                                                                Lurah
                                                            </option>
                                                            <option value="masyarakat"
                                                                <?= $value->level == 'masyarakat' ? 'selected' : null; ?>>
                                                                Masyarakat</option>
                                                        </select>
                                                    </div>

                                                    <div class="float-right">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <!-- End Modal Edit Pengguna -->

                                <!-- Modal Detail Pengguna -->
                                <?php foreach ($pengguna as $key => $value) : ?>
                                <div class="modal fade" id="detailBackdrop<?= $value->id_user ?>" data-backdrop="detail"
                                    data-keyboard="false" tabindex="-1"
                                    aria-labelledby="detailBackdropLabel<?= $value->id_user ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailBackdropLabel<?= $value->id_user ?>">
                                                    Detail
                                                    Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form untuk menampilkan detail data pengguna -->
                                                <form>
                                                    <div class="form-group">
                                                        <label for="nik">NIK</label>
                                                        <input type="text" class="form-control" id="nik"
                                                            value="<?= $value->nik; ?>" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="text" class="form-control" id="password"
                                                            value="<?= $value->password; ?>" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <input type="text" class="form-control" id="level"
                                                            value="<?= $value->level; ?>" disabled>
                                                    </div>
                                                    <div class="float-right">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Keluar</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <!-- End Modal Detail Pengguna -->


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const tableSearch = document.getElementById('tableSearch');
    const table = document.getElementById('example1');
    const tbody = table.querySelector('tbody');
    const rows = tbody.querySelectorAll('tr');

    tableSearch.addEventListener('keyup', function() {
        const filter = tableSearch.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(cell => {
                if (cell.innerText.toLowerCase().includes(filter)) {
                    match = true;
                }
            });
            if (match) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
<?= $this->endSection(); ?>