<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= base_url(); ?>/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="<?= base_url('admin/home'); ?>" class="d-block"><?= $nik; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->
            <li class="nav-header">Menu admin</li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/home'); ?>"
                    class="nav-link <?php echo ($active == 'admin') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/profile'); ?>"
                    class="nav-link <?php echo ($active == 'profile') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/keluhan'); ?>"
                    class="nav-link <?php echo ($active == 'keluhan') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Keluhan
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/laporan'); ?>"
                    class="nav-link <?php echo ($active == 'laporan') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Laporan
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/aspirasi'); ?>"
                    class="nav-link <?php echo ($active == 'aspirasi') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        Aspirasi
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/pertanyaan'); ?>"
                    class="nav-link <?php echo ($active == 'pertanyaan') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-question"></i>
                    <p>
                        Pertanyaan
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="<?= base_url('admin/berita'); ?>"
                    class="nav-link <?php echo ($active == 'berita') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Berita
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->