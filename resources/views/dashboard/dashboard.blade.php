@extends('layouts.master')
@section('style')
    <style>
        .c-dashboardInfo {
            margin-bottom: 15px;
        }

        .c-dashboardInfo .wrap {
            background: #ffffff;
            box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 7px;
            text-align: center;
            position: relative;
            overflow: hidden;
            padding: 40px 25px 20px;
            height: 100%;
        }

        .c-dashboardInfo__title,
        .c-dashboardInfo__subInfo {
            color: #6c6c6c;
            font-size: 1.18em;
        }

        .c-dashboardInfo span {
            display: block;
        }

        .c-dashboardInfo__count {
            font-weight: 600;
            font-size: 2.5em;
            line-height: 64px;
            color: #323c43;
        }

        .c-dashboardInfo .wrap:after {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 10px;
            content: "";
        }

        .c-dashboardInfo:nth-child(1) .wrap:after {
            background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
        }

        .c-dashboardInfo:nth-child(2) .wrap:after {
            background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
        }

        .c-dashboardInfo:nth-child(3) .wrap:after {
            background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
        }

        .c-dashboardInfo:nth-child(4) .wrap:after {
            background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
        }

        .c-dashboardInfo__title svg {
            color: #d7d7d7;
            margin-left: 5px;
        }

        .MuiSvgIcon-root-19 {
            fill: currentColor;
            width: 1em;
            height: 1em;
            display: inline-block;
            font-size: 24px;
            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            user-select: none;
            flex-shrink: 0;
        }
    </style>
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Dashboard @if (auth()->user()->can('admin'))
                    Admin
                @elseif (auth()->user()->can('keuangan'))
                    Keuangan
                @else
                    User
                @endif
            </h3>
            @if (auth()->user()->can('admin') ||
                    auth()->user()->can('keuangan'))
                <div class="card mt-3">
                    <div class="card-body">
                        {{-- <div class="d-flex justify-content-center flex-wrap row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Pegawai</h5>
                                        <h1>{{ $pegawai }}</h1>
                                        <a href="/data-pegawai">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Kegiatan</h5>
                                        <h1>{{ $kegiatan }}</h1>
                                        <a href="/data-kegiatan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Ruangan</h5>
                                        <h1>{{ $ruangan }}</h1>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Ruangan</h5>
                                        <h1>{{ $ruangan }}</h1>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row align-items-stretch">
                            {{-- @can('admin')
                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Data
                                            Pegawai</h4>
                                        <span class="hind-font caption-12 c-dashboardInfo__count">{{ $pegawai }}</span>
                                        <a href="/data-pegawai">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Data
                                            Kegiatan</h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $kegiatan }}</span>
                                        <a href="/data-kegiatan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Data
                                            Ruangan
                                        </h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $ruangan }}</span>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            @endcan
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <div class="wrap">
                                    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                        Akumulasi
                                        Keuangan Bulan ini</h4><span
                                        class="hind-font caption-12 c-dashboardInfo__count">€500</span><span
                                        class="hind-font caption-12 c-dashboardInfo__subInfo">Last month: €30</span>
                                </div>
                            </div> --}}
                            @can('admin')
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $pegawai }}</h3>

                                            <p>Data Pegawai</p>
                                        </div>
                                        <div class="icon">
                                            {{-- <i class="ion ion-bag"></i> --}}
                                        </div>
                                        <a href="/data-pegawai" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $kegiatan }}</h3>

                                            <p>Data Kegiatan</p>
                                        </div>
                                        <div class="icon">
                                            {{-- <i class="ion ion-stats-bars"></i> --}}
                                        </div>
                                        <a href="/data-kegiatan" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $ruangan }}</h3>

                                            <p>Data Ruangan</p>
                                        </div>
                                        <div class="icon">
                                            {{-- <i class="ion ion-person-add"></i> --}}
                                        </div>
                                        <a href="/data-ruangan" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endcan
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $akumulasi_biaya }}</h3>

                                        <p>Akumulasi Biaya Hari ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title"> Jadwal yang sudah terlaksana</h5>
                                        <h1>{{ $perubahan }}</h1>
                                        <a href="/history-jadwal">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title"> Jadwal yang akan datang</h5>
                                        <h1>{{ $perubahan }}</h1>
                                        <a href="/jadwal">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-60">
                                    <div class="card-body">
                                        <h5 class="card-title"> Perubahan Jadwal</h5>
                                        <h1>{{ $perubahan }}</h1>
                                        <a href="/perubahan-jadwal">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @can('admin')
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Jadwal Hari ini</span>
                                            <span class="info-box-number">
                                                {{ $jadwal_semua->count() }}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1"><i
                                                class="fas fa-thumbs-up"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Jadwal yang akan datang</span>
                                            {{ $jadwal_semua->count() }}
                                            <span class="info-box-number"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fas fa-shopping-cart"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Perubahan Jadwal</span>
                                            <span class="info-box-number">{{ $perubahan }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                        @endcan
                        <h4>Jadwal Keseluruhan Pegawai Hari ini</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @can('admin')
                                            <th>Kegiatan</th>
                                        @endcan
                                        <th>Pegawai</th>
                                        @can('admin')
                                            <th>Jumlah JP</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Jam</th>
                                            <th>Angkatan</th>
                                        @endcan
                                        <th>Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal_semua as $jdsm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @can('admin')
                                                <td>{{ isset($jdsm->kegiatan) ? $jdsm->kegiatan->nama_kegiatan : '-' }}</td>
                                            @endcan
                                            <td>{{ $jdsm->user->name ?? '-' }}</td>
                                            @can('admin')
                                                <td>{{ $jdsm->jp }}</td>
                                                <td>{{ date('d-m-Y', strtotime($jdsm->waktu_mulai)) }}</td>
                                                <td>{{ date('H:i', strtotime($jdsm->waktu_mulai)) }} -
                                                    {{ date('H:i', strtotime($jdsm->waktu_selesai)) }}</td>
                                                <td>{{ $jdsm->angkatan }}</td>
                                            @endcan
                                            <td>{{ $jdsm->biaya }}</td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="">Jadwal Hari ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kegiatan</th>
                                    <th>Jumlah JP</th>
                                    <th>Jam</th>
                                    <th>Angkatan</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal_pribadi as $jdpr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ isset($jdpr->kegiatan) ? $jdpr->kegiatan->nama_kegiatan : '-' }}</td>
                                        <td>{{ $jdpr->jp }}</td>
                                        <td>{{ date('H:i', strtotime($jdpr->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($jdpr->waktu_selesai)) }}</td>
                                        <td>{{ isset($jdpr->angkatan) ? $jdpr->angkatan : '-' }}</td>
                                        <td>{{ $jdsm->biaya }}</td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script></script>
@endsection
