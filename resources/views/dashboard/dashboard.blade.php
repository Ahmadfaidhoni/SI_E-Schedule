@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            @can('admin')
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Pegawai</h5>
                                        <br>
                                        <h1>{{ $pegawai }}</h1>
                                        <br>
                                        <a href="/data-pegawai">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Kegiatan</h5>
                                        <br>
                                        <h1>{{ $kegiatan }}</h1>
                                        <br>
                                        <a href="/data-kegiatan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Ruangan</h5>
                                        <br>
                                        <h1>{{ $ruangan }}</h1>
                                        <br>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"> Perubahan Jadwal</h5>
                                        <br>
                                        <h1>{{ $perubahan }}</h1>
                                        <br>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"> Perubahan Jadwal</h5>
                                        <br>
                                        <h1>{{ $perubahan }}</h1>
                                        <br>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"> Perubahan Jadwal</h5>
                                        <br>
                                        <h1>{{ $perubahan }}</h1>
                                        <br>
                                        <a href="/data-ruangan">
                                            <p>Lihat Data </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            @endcan
            <h4 class="">Jadwal Hari ini</h4>
            <div class="card">
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
