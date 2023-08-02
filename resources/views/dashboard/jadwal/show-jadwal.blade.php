@extends('layouts.master')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="sweetalert2.min.css"> --}}

    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Detail Jadwal</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="float-right">
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item">
                                <a href="editJadwal-{{ $jdwl->id }}">
                                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                        Edit Data</button>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                {{-- <form action="data-jadwal.{{ $jdwl->id }}" method="post" class="d-inline"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus jadwal ini?');"> --}}
                                <form action="data-jadwal.{{ $jdwl->id }}" method="post" class="d-inline"
                                    id="hapus-form">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapus()"><i
                                            class="bi bi-trash"></i>
                                        Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <table class="table table-profile">
                        <tbody>
                            <tr>
                                <th scope="row">Tipe Jadwal:</th>
                                @if ($jdwl->tipe_jadwal != 1)
                                    <td>Perjalanan Dinas</td>
                                @else
                                    <td>Mengajar</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">Pegawai:</th>
                                <td>{{ $jdwl->user_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal:</th>
                                <td>{{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) . ' s/d ' . date('d-m-Y', strtotime($jdwl->waktu_selesai)) }}</td>
                            </tr>
                            <tr style="display:{{ $jdwl->tipe_jadwal == '2' ? 'none' : '' }}">
                                <th scope="row">Waktu:</th>
                                <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                                    {{ date('H:i', strtotime($jdwl->waktu_selesai)) }} ({{ $jdwl->jp}} JP)</td>
                            </tr>
                            <tr style="display:{{ $jdwl->tipe_jadwal == '2' ? 'none' : '' }}">
                                <th scope="row">Kegiatan, Ruang & Angkatan: </th>
                                    <td>{{ isset($jdwl->nama_kegiatan) ? $jdwl->nama_kegiatan : '-' }}, {{ isset($jdwl->ruangan) ? $jdwl->ruangan->nama_ruangan : '-' }}, Angkatan {{ $jdwl->angkatan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan:</th>
                                <td>{{ isset($jdwl->keterangan) ? $jdwl->keterangan : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Biaya:</th>
                                <td>{{ isset($jdwl->biaya) ? number_format($jdwl->biaya) : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dibuat oleh:</th>
                                <td>{{ isset($jdwl->created_by) ? $jdwl->created_by : '-' }}</td>
                            </tr>
                            @if ($jdwl->edited_by != null)
                                <tr>
                                    <th scope="row">Diedit oleh:</th>
                                    <td>{{ isset($jdwl->edited_by) ? $jdwl->edited_by : '-' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <script>
        function hapus() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus jadwal ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-form').submit();
                }
            })
        }
    </script>
@endsection
