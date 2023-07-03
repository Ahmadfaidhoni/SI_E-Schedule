@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="">History Jadwal</h4>
            <div class="card">
                <div class="card-body">

                    @if (session()->has('success'))
                        <div class="alert alert-success my-3 mx-4 col-lg-8">
                            {{ session('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger my-3 mx-4 col-lg-8">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="ml-4" style="display: inline-block">
                        <a href="/"><button type="button" class="btn btn-primary"><i class="bi bi-arrow-bar-left"></i>
                                Back to Jadwal</button></a>
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
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $jdwl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($jdwl->tipe_jadwal == 2)
                                                Perjalanan Dinas
                                            @else
                                                {{ isset($jdwl->kegiatan) ? $jdwl->kegiatan->nama_kegiatan : '-' }}
                                            @endif
                                        </td>
                                        <td>{{ isset($jdwl->user) ? $jdwl->user->name : '-' }}</td>
                                        <td>
                                            @if ($jdwl->jp < 15)
                                                {{ $jdwl->jp }}
                                            @else
                                                Full Day
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }}</td>

                                        <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                                        <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                                        <td>
                                            {{ $jdwl->status }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
