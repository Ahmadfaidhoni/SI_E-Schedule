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
                            @can('admin')
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
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
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
                        </div>

                        <h4>Jadwal Keseluruhan Pegawai Hari ini</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Pegawai</th>
                                        <th>Jumlah JP</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Jam</th>
                                        <th>Angkatan</th>
                                        <th>Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal_semua as $jdsm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ isset($jdsm->kegiatan) ? $jdsm->kegiatan->nama_kegiatan : '-' }}</td>
                                            <td>{{ $jdsm->user->nama }}</td>
                                            <td>{{ $jdsm->jp }}</td>
                                            <td>{{ $jdsm->tanggal }}</td>
                                            <td>{{ date('H:i', strtotime($jdsm->waktu_mulai)) }} -
                                                {{ date('H:i', strtotime($jdsm->waktu_selesai)) }}</td>
                                            <td>{{ $jdsm->angkatan }}</td>
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
                                        <td></td>
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
