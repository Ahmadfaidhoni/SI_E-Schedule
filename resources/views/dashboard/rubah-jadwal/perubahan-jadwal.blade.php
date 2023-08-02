@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Perubahan Jadwal</h4>
            <div class="card mt-3 mx-3">
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
                                    <th>Ruangan</th>
                                    <th>Aksi</th>

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
                                                {{ $jdwl->kegiatan->nama_kegiatan }}
                                            @endif
                                        </td>
                                        @can('admin')
                                            <td>{{ isset($jdwl->user) ? $jdwl->user->name : '-' }}</td>
                                        @endcan
                                        <td>
                                            @if ($jdwl->jp < 15)
                                                {{ $jdwl->jp }}
                                            @else
                                                Full Day
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }} s/d {{ date('d-m-Y', strtotime($jdwl->waktu_selesai)) }} </td>
                                        <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                                        <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                                        <td>{{ isset($jdwl->ruangan) ? $jdwl->ruangan->nama_ruangan : '-' }}</td>
                                        <td class="text-center">
                                            @if (Auth::user()->level == 'Admin')
                                                <div class="row">
                                                    <div class="col-lg-12" style="white-space: nowrap">
                                                        <a href="ubah-jadwal-{{ $jdwl->id }}"><button type="button"
                                                                class="btn btn-sm mb-1 btn-primary"><i
                                                                    class="bi bi-eye"></i> Lihat</button></a>
                                                        <form action="tolak-jadwal.{{ $jdwl->id }}" method="post" class="d-inline">
                                                            @method('patch')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm mb-1 btn-danger" onclick="return confirm('Apakah anda yakin ingin menolak jadwal ini?');"><i class="bi bi-dash-circle"></i> Tolak</button>
                                                        </form>

                                                        {{-- button to open modal --}}
                                                        {{-- <button type="button"
                                                            class="btn btn-sm mb-1 btn-warning text-white"
                                                            data-toggle="modal" data-target="#modal-tolak">
                                                            <i class="bi bi-dash-circle"></i> Tolak
                                                        </button> --}}

                                                    </div>
                                                </div>
                                            @elseif(Auth::user()->level == 'User' || Auth::user()->level == 'Keuangan')
                                                <button type="button" class="btn btn-sm mb-1 btn-warning"
                                                    style="pointer-events: none">Dalam Pengecekan</button>
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

    {{-- <div class="modal fade" id="modal-tolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Penolakan Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="tolak-jadwal" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $jdwl->id ?? '' }}">
                    <div class="modal-body">
                        <label for="comment">Komentar:</label>
                        <input type="text" id="comment" name="comment" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
