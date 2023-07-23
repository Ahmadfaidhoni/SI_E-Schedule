@extends('layouts.master')
@section('style')
    <style>

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
            @if (auth()->user()->can('admin'))
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row align-items-stretch">
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h4> {{ $jadwal_pribadi->count() }}</h4>

                                        <p>Jadwal Terlaksana Hari ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-document"></i>
                                    </div>
                                    <a href="/jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h4>{{ $jadwal_next_from_today->count() }}</h4>

                                        <p>Jadwal Yang Akan Datang</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-calendar"></i>
                                    </div>
                                    <a href="/jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h4>{{ $perubahan }}</h4>

                                        <p>Perubahan Jadwal</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-clock"></i>
                                    </div>
                                    <a href="/perubahan-jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            {{-- <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h4>{{ $akumulasi_biaya ? number_format($akumulasi_biaya) : 0 }}</h4>

                                        <p>Pendapatan Bulan Ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <a href="/data-pegawai" class="col-12 col-sm-6 col-md-3"
                                style="color: inherit; text-decoration: none;">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Data Pegawai</span>
                                        <span class="info-box-number">
                                            {{ $pegawai }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="/data-kegiatan" class="col-12 col-sm-6 col-md-3"
                                style="color: inherit; text-decoration: none;">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Data Kegiatan</span>
                                        <span class="info-box-number">
                                            {{ $kegiatan }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="/data-ruangan" class="col-12 col-sm-6 col-md-3"
                                style="color: inherit; text-decoration: none;">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-building"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Data Ruangan</span>
                                        {{ $ruangan }}
                                        <span class="info-box-number"></span>
                                    </div>
                                </div>
                            </a>
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i
                                            class="fas fa-money-bill"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Pendapatan Bulan ini </span>
                                        <span class="info-box-number">{{ number_format($akumulasi_biaya) }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="row align-items-stretch">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4> {{ $jadwal_pribadi->count() }}</h4>

                                    <p>Jadwal Terlaksana Hari ini</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document"></i>
                                </div>
                                <a href="/jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4>{{ $jadwal_next_from_today->count() }}</h4>

                                    <p>Jadwal Yang Akan Datang</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a href="/jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h4>{{ $perubahan }}</h4>

                                    <p>Perubahan Jadwal</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clock"></i>
                                </div>
                                <a href="/perubahan-jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger p-3">
                                <div class="inner">
                                    <h4>{{ $akumulasi_biaya ? number_format($akumulasi_biaya) : 0 }}</h4>
                                    <p>Pendapatan Bulan ini</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer pe-none">
                                    <i class="fas fa-arrow-circle-right my-1" style="opacity: 0;"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->can('admin'))
                <div class="card mt-3">
                    <div class="card-body">
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
                                            <td>
                                                @if ($jdsm->tipe_jadwal == 2)
                                                    Perjalanan Dinas
                                                @else
                                                    {{ isset($jdsm->kegiatan) ? $jdsm->kegiatan->nama_kegiatan : '-' }}
                                                @endif
                                            </td>
                                            <td>{{ $jdsm->user->name ?? '-' }}</td>
                                            <td>{{ $jdsm->jp }}</td>
                                            <td>{{ date('d-m-Y', strtotime($jdsm->waktu_mulai)) }}</td>
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
                    <h4 class="">Jadwal Pribadi Hari ini</h4>
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
                                        {{-- <td>{{ isset($jdpr->kegiatan) ? $jdpr->kegiatan->nama_kegiatan : '-' }}</td> --}}
                                        <td>
                                            @if ($jdpr->tipe_jadwal == 2)
                                                Perjalanan Dinas
                                            @else
                                                {{ isset($jdpr->kegiatan) ? $jdpr->kegiatan->nama_kegiatan : '-' }}
                                            @endif
                                        </td>
                                        <td>{{ $jdpr->jp }}</td>
                                        <td>{{ date('H:i', strtotime($jdpr->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($jdpr->waktu_selesai)) }}</td>
                                        <td>{{ isset($jdpr->angkatan) ? $jdpr->angkatan : '-' }}</td>
                                        <td>{{ $jdpr->biaya }}</td>
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
