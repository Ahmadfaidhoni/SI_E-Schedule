@extends('layouts.master')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Perubahan Jadwal {{ $jadwal->user->name }}
            </div>
            <div class="card-body">
                <div class="float-right">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item">
                            <a href="editJadwal-{{ $jadwal->id }}"><button type="button" class="btn btn-sm mb-1 btn-warning text-white"><i class="bi bi-pencil-square"></i> Edit</button></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="data-jadwal.{{ $jadwal->id }}" method="post" class="d-inline" onclick="return confirm('Apakah anda yakin ingin menghapus jadwal ini');">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm mb-1 btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <table class="table table-profile">
                    <tbody>
                    <tr>
                        <th scope="row">Kegiatan:</th>
                        @if($jadwal->tipe_jadwal == 2)
                            <td>Perjalanan Dinas</td>
                        @else
                            <td>{{ isset($jadwal->kegiatan)?$jadwal->kegiatan->nama_kegiatan: '-' }}</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Pegawai:</th>
                        <td>{{ $jadwal->user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal:</th>
                        <td>{{ date('d-m-Y', strtotime($jadwal->waktu_mulai)); }}</td>
                    </tr>
                    <tr style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                        <th scope="row">Waktu:</th>
                        <td>{{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
                    </tr>
                    <tr style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                        <th scope="row">Jam Pelajaran:</th>
                        <td>{{ $jadwal->jp }}</td>
                    </tr>
                    <tr style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                        <th scope="row">Angkatan:</th>
                        <td>{{ $jadwal->angkatan }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Keterangan:</th>
                        <td>{{ isset($jadwal->keterangan)?$jadwal->keterangan: '-' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Alasan:</th>
                        <td class="text-danger">{{ isset($jadwal->alasan)?$jadwal->alasan: '-' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection