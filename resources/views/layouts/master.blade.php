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
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- CSS only -->

    <!-- Date picker plugins css -->
    <link href="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


</head>

<body>
    @include('sweetalert::alert')

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/" class="text-decoration-none">
                    {{-- <b class="logo-abbr"><img src="images/logo.png" alt=""> </b> --}}
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <h3 class="text-white text-center">E-Schedule</h3>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>

                @auth
                    <div class="header-right">
                        <ul class="clearfix">
                            <li class="icons dropdown d-none d-md-flex">
                                <a class="log-user">
                                    <span>Selamat Datang, {{ auth()->user()->name }}</span>
                                </a>
                            </li>
                            <li class="icons dropdown">
                                <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                    <span class="activity active"></span>
                                    <img src="images/user/1.png" height="40" width="40" alt="">
                                </div>
                                <div class="drop-down dropdown-profile   dropdown-menu">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="/profile" class="text-decoration-none text-muted"><i
                                                        class="icon-user"></i> <span>Profile</span></a>
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
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard @can('admin')
                            Admin
                        @endcan
                    </li>
                    <li>
                        <a href="/" aria-expanded="false" class="text-decoration-none">
                            <i class="bi bi-house"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow text-decoration-none" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Penjadwalan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="/jadwal" class="text-decoration-none">
                                    <i class="bi bi-calendar3"></i>Jadwal
                                </a>
                            </li>
                            <li><a href="/perubahan-jadwal" class="text-decoration-none">
                                    <i class="icon-note menu-icon"></i>Perubahan Jadwal
                                </a>
                            </li>
                        </ul>
                    </li>
                    @can('admin')
                        <li>
                            <a href="/data-pegawai" aria-expanded="false" class="text-decoration-none">
                                <i class="bi bi-people"></i><span class="nav-text">Data Pegawai</span>
                            </a>
                        </li>
                        <li>
                            <a href="/data-kegiatan" aria-expanded="false" class="text-decoration-none">
                                <i class="bi bi-bookmark"></i><span class="nav-text">Data Kegiatan</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="/data-golongan" aria-expanded="false" class="text-decoration-none">
                                <i class="bi bi-award"></i><span class="nav-text">Data Golongan</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="/data-ruangan" aria-expanded="false" class="text-decoration-none">
                                <i class="bi bi-door-open"></i><span class="nav-text">Data Ruangan</span>
                            </a>
                        </li>
                    @endcan
                    @can('keuangan')
                        <li>
                            <a class="has-arrow text-decoration-none" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Keuangan</span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="/keuangan" class="text-decoration-none">
                                        <i class="bi bi-currency-dollar"></i>Master Keuangan
                                    </a>
                                </li>
                                {{-- <li><a href="/perubahan-jadwal" class="text-decoration-none">
                                    <i class="icon-note menu-icon"></i>Laporan
                                </a>
                            </li> --}}
                            </ul>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

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
                <p>Copyright &copy; PPSDM Regional Bandung @2022</p>
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
    {{-- <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

    @yield('page_script')

</body>

</html>
