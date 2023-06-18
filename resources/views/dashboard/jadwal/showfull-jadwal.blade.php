@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="card-title">Data Jadwal {{ $user->name }}</h4>
        <div class="card">
            <div class="card-body">
                @can('admin')
                    <div class="mx-4">
                        <a href="/"><button type="button" class="btn btn-primary"><i class="bi bi-arrow-bar-left"></i> Back To Jadwal</button></a>
                    </div>
                @endcan

                @if(session()->has('success'))
                <div class="alert alert-success my-3 mx-4 col-lg-8">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Pengajar</th>
                                <th>Jumlah Jam Pelajaran</th>
                                <th>Tanggal</th>
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
                                        {{ isset($jdwl->kegiatan)?$jdwl->kegiatan->nama_kegiatan: '-' }}
                                    @endif    
                                </td>
                                <td>{{ isset($jdwl->user)?$jdwl->user->name:'-' }}</td>
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
                                    @can('admin')
                                    <div class="row">
                                        <div class="col-lg-12" style="white-space: nowrap">
                                            <a href="editJadwal-{{ $jdwl->id }}"><button type="button" class="btn btn-sm mb-1 btn-warning text-white"><i class="bi bi-pencil-square"></i> Edit</button></a>
                                            <form action="data-jadwal.{{ $jdwl->id }}" method="post" class="d-inline" onclick="return confirm('Apakah anda yakin ingin menghapus jadwal ini?');">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm mb-1 btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    @endcan
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