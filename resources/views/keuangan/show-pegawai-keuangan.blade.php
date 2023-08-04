@extends('layouts.master')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    <div class="row">
        <div class="col-12">
            <h4 class="mx-3"> Data Pegawai {{ $user->name }}</h4>
            <div class="card mt-3 mx-3">
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
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe Jadwal</th>
                                    <th>Jumlah JP</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Jam</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keuangan as $kn)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kn->tipe_jadwal == 1 ? 'Mengajar' : 'Perjalanan Dinas' }}</td>
                                        <td>{{ $kn->jp ?? 0 }}</td>
                                        <td>{{ date('d-m-Y', strtotime($kn->waktu_mulai)) }}</td>
                                        <td>{{ date('H:i', strtotime($kn->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($kn->waktu_selesai)) }}</td>
                                        <td>{{ $kn->biaya ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
@endsection
