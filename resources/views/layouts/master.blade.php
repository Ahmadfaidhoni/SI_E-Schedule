<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="Aplikasi E-Schedule PPSDM Regional Bandung">
    <meta name="description"
        content="Aplikasi E-Schedule PPSDM Regional Bandung, E-Schedule Widya Iswara, E-Schedule WI">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>APWI-Schedule</title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- CSS only -->

    <!-- Date picker plugins css -->
    <link href="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./template/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./template/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./template/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./template/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./template/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('sweetalert::alert')

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="icons dropdown d-none d-md-flex">
                        <a class="nav-link">
                            <span>Selamat Datang, {{ auth()->user()->name }}</span>
                        </a>
                    </li>
                    <li class="icons dropdown mr-3">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{ file_exists(auth()->user()->picture) ? url(auth()->user()->picture) : url('images/user/user.png') }}"
                                height="40" width="40" alt="" class="rounded-circle">
                        </div>
                        <div class="drop-down dropdown-profile   dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="/profile" class="text-decoration-none text-muted"><i class="icon-user"></i>
                                            <span>Profile</span></a>
                                    </li>
                                    <hr class="my-2">

                                    <li>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <button type="submit" class="button-logout">
                                                <i class="icon-key"></i> <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endauth
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link">
                <img src="images/logo/logo.png" alt="AdminLTE Logo" class="bg-white img-circle elevation-3" width="50"
                    height="50">
                <span class="ml-3 brand-text font-weight-light">E-Schedule</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/" aria-expanded="false"
                                class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'dashboard' ? 'active' : '' }} @endif">
                                <i class="bi bi-house nav-icon"></i>
                                <p>
                                    <span class="nav-text">Dashboard</span>
                                </p>
                            </a>
                        </li>

                        <li
                            class="nav-item @if (!empty($active_menu)) {{ $active_menu == 'jadwal' || $active_menu == 'perubahan-jadwal' ? 'menu-open' : '' }} @endif">
                            <a href="#" class="nav-link">
                                <i class="icon-speedometer nav-icon"></i>
                                <p>
                                    Penjadwalan
                                    <i class="fas fa-angle-left right"></i>
                                    {{-- <span class="badge badge-info right">6</span> --}}
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/jadwal"
                                        class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'jadwal' ? 'active' : '' }} @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/perubahan-jadwal"
                                        class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'perubahan-jadwal' ? 'active' : '' }} @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Perubahan Jadwal</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @can('admin')
                        <li class="nav-item">
                            <a href="/data-pegawai" aria-expanded="false"
                                class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'data-pegawai' ? 'active' : '' }} @endif">
                                <i class="bi nav-icon bi-people"></i>
                                <p><span class="nav-text">Data Pegawai</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-kegiatan" aria-expanded="false"
                                class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'data-kegiatan' ? 'active' : '' }} @endif">
                                <i class="bi nav-icon bi-bookmark"></i>
                                <p><span class="nav-text">Data Kegiatan</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-ruangan" aria-expanded="false"
                                class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'data-ruangan' ? 'active' : '' }} @endif">
                                <i class="bi nav-icon bi-door-open"></i>
                                <p><span class="nav-text">Data Ruangan</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/config" aria-expanded="false"
                                class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'config' ? 'active' : '' }} @endif">
                                <i class="bi nav-icon bi-gear"></i>
                                <p><span class="nav-text">Config</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('keuangan')

                        <li
                            class="nav-item @if (!empty($active_menu)) {{ $active_menu == 'keuangan' ? 'menu-open' : '' }} @endif">
                            <a href="#" class="nav-link">
                                <i class="icon-speedometer nav-icon"></i>
                                <p>
                                    Keuangan
                                    <i class="fas fa-angle-left right"></i>
                                    {{-- <span class="badge badge-info right">6</span> --}}
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/keuangan"
                                        class="nav-link @if (!empty($active_menu)) {{ $active_menu == 'keuangan' ? 'active' : '' }} @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Keuangan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                    </ul>
                </nav>
            </div>
        </aside>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <div class="content-wrapper">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; PPSDM Regional Bandung @2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <script src="./plugins/validation/jquery.validate.min.js"></script>
    <script src="./plugins/validation/jquery.validate-init.js"></script>
    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <!-- plugin DataTable -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- plugin Buttons -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>

    <!-- Clock Plugin JavaScript -->
    <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>

    <script src="./plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <!-- Bootstrap 4 -->
    <script src="./template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="./template/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./template/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./template/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./template/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./template/plugins/moment/moment.min.js"></script>
    <script src="./template/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./template/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./template/dist/js/adminlte.js"></script>
    {{-- <!-- AdminLTE for demo purposes -->
    <script src="./template/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./template/dist/js/pages/dashboard.js"></script> --}}




    <script src="./template/plugins/jquery/jquery.min.js"></script>
    <script src="./template/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="./template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="./template/plugins/jszip/jszip.min.js"></script>
    <script src="./template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="./template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="./template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    @yield('page_script')

</body>

</html>
