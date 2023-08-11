@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="mx-3">Perubahan Jadwal</h4>
        <div class="card mt-3 mx-3">
            <div class="card-body">
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
                                @if (Auth::user()->level != 'Admin')
                                <th>Biaya</th>
                                @endif
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
                                        {{ $jdwl->kegiatan->kode_kegiatan }}
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
                                    <td> {{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }} s/d {{ date('d-m-Y', strtotime($jdwl->waktu_selesai)) }} </td>
                                    <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} - {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                                    <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                                    <td>{{ isset($jdwl->ruangan) ? $jdwl->ruangan->nama_ruangan : '-' }}</td>
                                    @if (Auth::user()->level != 'Admin')
                                        <td>{{ number_format($keuangan->biaya) ?? '-' }}</td>
                                    @endif
                                    <td class="text-center">
                                        @if (Auth::user()->level == 'Admin')
                                            <div class="row">
                                                <div class="col-lg-12" style="white-space: nowrap">
                                                    <a href="ubah-jadwal-{{ $jdwl->id }}"><button type="button"
                                                            class="btn btn-sm mb-1 btn-primary"><i class="bi bi-eye"></i>
                                                            Lihat</button></a>
                                                    <form method="post" class="d-inline"
                                                        id="tolak-form">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="button" onclick="tolak({{ $jdwl->id }})"
                                                            class="btn btn-sm mb-1 btn-danger"><i class="bi bi-dash-circle"></i>
                                                            Tolak</button>
                                                    </form>
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
<script>
    function tolak(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apakah anda yakin ingin menolak jadwal ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tolak!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#tolak-form').attr('action', '/tolak-jadwal/' + id);
                $('#tolak-form').submit();
            }
        })
    }
</script>
@endsection
