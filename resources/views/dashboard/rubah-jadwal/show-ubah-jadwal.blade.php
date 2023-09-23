@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">
                Permintaan Perubahan Jadwal {{ $jadwal->user->name }}
            </h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="float-right">
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item">
                                <a href="editJadwal-{{ $jadwal->id }}"><button type="button"
                                        class="btn btn-sm mb-1 btn-warning"><i class="bi bi-pencil-square"></i>
                                        Edit</button></a>
                            </li>
                            <li class="list-inline-item">
                                <form action="data-jadwal.{{ $jadwal->id }}" method="post" class="d-inline"
                                    id="hapus-form">
                                    @method('delete')
                                    @csrf
                                    <button type="button" onclick="hapus()" class="btn btn-sm mb-1 btn-danger"><i
                                            class="bi bi-trash"></i>
                                        Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <table class="table table-profile">
                        <tbody>
                            <tr>
                                <th scope="row">Kegiatan:</th>
                                @if ($jadwal->tipe_jadwal == 2)
                                    <td>Perjalanan Dinas</td>
                                @else
                                    <td>{{ isset($jadwal->kegiatan) ? $jadwal->kegiatan->nama_kegiatan : '-' }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">Pegawai:</th>
                                <td>{{ $jadwal->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal:</th>
                                <td>{{ date('d-m-Y', strtotime($jadwal->waktu_mulai)) }}</td>
                            </tr>
                            <tr style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                                <th scope="row">Waktu:</th>
                                <td>{{ date('H:i', strtotime($jadwal->waktu_mulai)) }} -
                                    {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
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
                                <td>{{ isset($jadwal->keterangan) ? $jadwal->keterangan : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Alasan:</th>
                                <td class="text-danger">{{ isset($jadwal->alasan) ? $jadwal->alasan : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dokumen Pendukung:</th>
                                <td>
                                    <a href="{{ isset($jadwal->file_alasan) ? $jadwal->file_alasan : '-' }}"
                                        target="_blank">
                                        <button type="button" class="btn btn-sm mb-1 btn-primary"><i
                                                class="bi bi-file-earmark-pdf"></i>
                                            Lihat</button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
