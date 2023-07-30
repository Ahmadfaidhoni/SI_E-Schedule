@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Data Jadwal</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    @can('admin')
                        <div class="" style="display: inline-block">
                            <a href="/add-jadwal"><button type="button" class="btn btn-primary"><i
                                        class="bi bi-calendar-plus"></i> Tambah Jadwal</button></a>
                        </div>
                    @endcan
                    <div class="mx-2" style="display: inline-block">
                        <a href="/history-jadwal"><button type="button" class="btn btn-info"><i
                                    class="bi bi-calendar2-week"></i> History</button></a>
                    </div>
                    <div class="" style="display: inline-block">
                        @can('admin')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-file-earmark-pdf"></i>
                                Export to PDF
                            </button>
                        @endcan
                    </div>

                    {{-- make modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Export PDF</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- input date range --}}
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Tanggal</span>
                                        </div>
                                        <input type="date" id="date-awal" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Tanggal</span>
                                        </div>
                                        <input type="date"id="date-akhir" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button onclick="myFunction()" class="btn btn-primary">Export</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-align-center">Kegiatan</th>
                                    <th>Pegawai</th>
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
                                        <td>
                                            @if ($jdwl->tipe_jadwal == 2)
                                                {{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) . ' - ' . date('d-m-Y', strtotime($jdwl->waktu_selesai)) }}
                                            @else
                                                {{ date('d-m-Y', strtotime($jdwl->waktu_mulai)) }}
                                            @endif
                                        </td>


                                        <td>{{ date('H:i', strtotime($jdwl->waktu_mulai)) }} -
                                            {{ date('H:i', strtotime($jdwl->waktu_selesai)) }}</td>
                                        <td>{{ isset($jdwl->angkatan) ? $jdwl->angkatan : '-' }}</td>
                                        <td>{{ isset($jdwl->ruangan_id) ? $jdwl->ruangan->nama_ruangan : '-' }}</td>
                                        <td>
                                            @if (Auth::user()->level == 'Admin')
                                                <div class="row text-center">
                                                    <div class="col-lg-12" style="white-space: nowrap">
                                                        <a href="data-jadwal-{{ $jdwl->id }}"><button type="button"
                                                                class="btn btn-sm mb-1 btn-primary"><i
                                                                    class="bi bi-eye"></i> Lihat</button></a>
                                                    </div>
                                                </div>
                                            @elseif(Auth::user()->level == 'User' || Auth::user()->level == 'Keuangan')
                                                <a href="{{ $jdwl->id }}.editJadwal"><button type="button"
                                                        class="btn btn-sm mb-1 btn-danger text-white">Request Ubah
                                                        Jadwal</button></a>
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
@section('page_script')
    <script>
        function myFunction() {
            // get value from date
            var date_awal = document.getElementById('date-awal').value;
            var date_akhir = document.getElementById('date-akhir').value;
            // window.location.href = '/export-jadwal/' + date_awal + '/' + date_akhir, '_blank';
            window.open('/export-jadwal/' + date_awal + '/' + date_akhir, '_blank');

        }
    </script>
@endsection
