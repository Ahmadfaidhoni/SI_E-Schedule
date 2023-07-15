@extends('layouts.master')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Data Pegawai {{ $user->name }}
                </div>
                <div class="card-body">
                    <table class="table table-profile">
                        <tbody>
                            <tr>
                                <th scope="row">NIP:</th>
                                <td>{{ $user->nip }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keuangan as $kn)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kn->nama_kegiatan ?? '-' }}</td>
                                    <td>{{ $kn->biaya }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tbody>
                        @foreach ($pegawai as $pgw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pgw->nip }}</td>
                            <td>{{ $pgw->name }}</td>
                            <td>{{ $pgw->jabatan }}</td>
                            <td>{{ isset($pgw->golongan)?$pgw->golongan->nama_pangkat:'- ' }} - {{ isset($pgw->golongan)?$pgw->golongan->jenis_golongan:'- ' }}/{{ isset($pgw->golongan)?$pgw->golongan->ruang:' -' }}</td>
                            <td>{{ isset($pgw->email)?$pgw->email:'-' }}</td>
                            <td class="text-center">
                                @if ($pgw->status_anggota == 1)
                                    <button type="button" class="btn btn-success btn-sm text-white">Aktif</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm text-white">Tidak Aktif</button>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="data-keuangan-pegawai-{{ $pgw->nip }}"><button type="button" class="btn btn-sm mb-1 btn-primary"><i class="bi bi-eye"></i> Lihat</button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
@endsection
