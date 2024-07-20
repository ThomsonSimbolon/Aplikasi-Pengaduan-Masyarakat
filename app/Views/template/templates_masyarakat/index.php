<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>/AdminLTE/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->

    <!-- Link untuk memanggil favicon css -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/custom-css/img/favicon_pengaduan.png" type="image/x-icon">
    <!-- End Link untuk memanggi favicon css -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('template/templates_masyarakat/topbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary bg-gradient-light elevation-4">
            <?= $this->include('template/templates_masyarakat/sidebar'); ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection('content-masyarakat'); ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 ~ Aplikasi Sistem Pengaduan Masyarakat</strong>
            All rights reserved
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(); ?>/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/AdminLTE/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url(); ?>/AdminLTE/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>/AdminLTE/dist/js/demo.js"></script>
    <!-- Code injected by live-server -->

    <!-- Script Code Custom-css/js -->
    <script src="<?= base_url(); ?>/assets/custom-css/js/main.js"></script>

    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                // var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                // var address = protocol + window.location.hostname  + window.location.pathname + '/ws';
                // var socket = new WebSocket(address);
                // socket.onmessage = function(msg) {
                //     if (msg.data == 'reload') window.location.reload();
                //     else if (msg.data == 'refreshcss') refreshCSS();
                // };
                // if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                //     console.log('Live reload enabled.');
                //     sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                // }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

</html>