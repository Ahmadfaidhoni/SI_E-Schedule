@extends('layouts.master')
@section('style')
    <style>

    </style>
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="mx-3">Dashboard @if (auth()->user()->can('admin'))
                    Admin
                @elseif (auth()->user()->can('keuangan'))
                    Keuangan
                @else
                    User
                @endif
            </h3>
            {{-- ADMIN DASHBOARD --}}
            @if (auth()->user()->can('admin'))
                <div class="card mt-3 mx-3">
                    <div class="card-body">
                        <div class="row align-items-stretch">
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h4> {{ $jadwal_semua->count() }}</h4>

                                        <p>Jadwal Yang Sedang Dilaksanakan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-calendar-event" style="font-size: 4rem;"></i>
                                    </div>
                                    <a href="/jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h4>{{ $all_jadwal_next_from_today->count() }}</h4>

                                        <p>Jadwal Yang Akan Datang</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-calendar-week" style="font-size: 4rem;"></i>
                                    </div>
                                    <a href="/jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h4>{{ $all_perubahan }}</h4>

                                        <p>Perubahan Jadwal</p>
                                    </div>
                                    <div class="icon">
                                        <i class="bi bi-clock" style="font-size: 4rem;"></i>
                                    </div>
                                    <a href="/perubahan-jadwal" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-6">
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
                                        <span class="info-box-number">Rp {{ number_format($akumulasi_biaya) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END ADMIN DASHBOARD --}}
            @else
                {{-- USER DASHBOARD --}}
                <div class="card-body">
                    <div class="row align-items-stretch">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4> {{ $jadwal_pribadi->count() }}</h4>

                                    <p>Jadwal Yang Sedang Dilaksanakan</p>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-calendar-event" style="font-size: 4rem;"></i>
                                </div>
                                <a href="/jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>{{ $jadwal_next_from_today->count() }}</h4>

                                    <p>Jadwal Yang Akan Datang</p>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-calendar-week" style="font-size: 4rem;"></i>
                                </div>
                                <a href="/jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h4>{{ $perubahan }}</h4>

                                    <p>Perubahan Jadwal</p>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-clock" style="font-size: 4rem;"></i>
                                </div>
                                <a href="/perubahan-jadwal" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success p-3">
                                <div class="inner">
                                    <h4>Rp {{ $akumulasi_biaya ? number_format($akumulasi_biaya) : 0 }}</h4>
                                    <p>Pendapatan Bulan ini</p>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-currency-dollar" style="font-size: 4rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END USER DASHBOARD --}}
            @endif

            {{-- START TABLE ALL PEGAWAI --}}
            @if (auth()->user()->can('admin'))
                <div class="card mt-3 mx-3">
                    <div class="card-body">
                        <h4>Jadwal Seluruh Pegawai Hari ini</h4>
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
                                        <th>Aksi</th>
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
                                            <td class="text-center">
                                                <div class="" style="white-space: nowrap">
                                                    <a href="data-jadwal-{{ $jdsm->id }}"><button type="button"
                                                            class="btn btn-sm mb-1 btn-primary"><i class="bi bi-eye"></i>
                                                            Lihat</button></a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            {{-- END TABLE ALL PEGAWAI --}}
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <h4>Jadwal Pribadi Hari ini</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kegiatan</th>
                                    <th>Jumlah JP</th>
                                    <th>Jam</th>
                                    <th>Angkatan</th>
                                    <th>Ruangan</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
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
                                        <td>{{ isset($jdpr->ruangan) ? $jdpr->ruangan->nama_ruangan : '-' }}</td>
                                        <td>{{ $jdpr->biaya }}</td>
                                        <td class="text-center">
                                            @if (Auth::user()->level == 'Admin')
                                                <div class="row text-center">
                                                    <div class="col-lg-12" style="white-space: nowrap">
                                                        <a href="data-jadwal-{{ $jdpr->id }}"><button type="button"
                                                                class="btn btn-sm mb-1 btn-primary"><i
                                                                    class="bi bi-eye"></i> Lihat</button></a>
                                                    </div>
                                                </div>
                                            @elseif(Auth::user()->level == 'User' || Auth::user()->level == 'Keuangan')
                                                <a href="{{ $jdpr->id }}.editJadwal"><button type="button"
                                                        class="btn btn-sm mb-1 btn-danger text-white">Request Ubah
                                                        Jadwal</button></a>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <div class="row justify-content-center">
                                                <div class="" style="white-space: nowrap">
                                                    <a href="data-jadwal-{{ $jdpr->id }}"><button type="button"
                                                            class="btn btn-sm mb-1 btn-primary"><i class="bi bi-eye"></i>
                                                            Lihat</button></a>
                                                </div>
                                            </div>
                                        </td> --}}
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
