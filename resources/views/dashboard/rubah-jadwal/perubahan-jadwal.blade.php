@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="">Perubahan Jadwal</h4>
        <div class="card">
            <div class="card-body">
                
                @if(session()->has('success'))
                <div class="alert alert-success my-3 mx-4 col-lg-8">
                    {{ session('success') }}
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger my-3 mx-4 col-lg-8">
                    {{ session('error') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                @can('admin')
                                <th>Pegawai</th>
                                @endcan
                                <th>Jumlah JP</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Jam</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal as $jdwl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($jdwl->tipe_jadwal == 2)
                                        Perjalanan Dinas
                                    @else
                                        {{ $jdwl->kegiatan->nama_kegiatan }}
                                    @endif
                                </td>
                                @can('admin')
                                <td>{{ isset($jdwl->user)?$jdwl->user->name:'-' }}</td>
                                @endcan
                                <td>
                                    @if($jdwl->jp < 15)
                                        {{ $jdwl->jp }}
                                    @else
                                        Full Day
                                    @endif
                                </td>
                                <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)); }}</td>
                                <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} - {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                                <td>{{ isset($jdwl->angkatan)?$jdwl->angkatan:'-' }}</td>
                                <td>
                                    @if(Auth::user()->level == 'Admin')
                                    <div class="row">
                                        <div class="col-lg-12" style="white-space: nowrap">
                                            <a href="ubah-jadwal-{{ $jdwl->id }}"><button type="button" class="btn btn-sm mb-1 btn-primary"><i class="bi bi-eye"></i> Lihat</button></a>
                                            <form action="tolak-jadwal.{{ $jdwl->id }}" method="post" class="d-inline">
                                                @method('patch')
                                                @csrf
                                                <button type="submit" class="btn btn-sm mb-1 btn-warning text-white" onclick="return confirm('Apakah anda yakin ingin menolak jadwal ini?');"><i class="bi bi-dash-circle"></i> Tolak</button>
                                            </form>
                                        </div>
                                    </div>
                                    @elseif(Auth::user()->level == 'User')
                                        <button type="button" class="btn btn-sm mb-1 btn-warning text-white" style="pointer-events: none">Dalam Pengecekan</button>
                                    @endif
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