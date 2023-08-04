@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Data Keuangan Pegawai</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i
                            class="bi bi-file-earmark-excel"></i>
                        Export to Excel
                    </button>
                    {{-- @if (session()->has('success'))
                        <div class="alert alert-success my-3 mx-4 col-lg-8">
                            {{ session('success') }}
                        </div>
                    @endif --}}

                    {{-- <div class="mx-4">
                    <a href="/add-pegawai"><button type="button" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah Pegawai</button></a>
                </div> --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration" id="example" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $pgw)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pgw->nip }}</td>
                                        <td>{{ $pgw->name }}</td>
                                        <td>{{ $pgw->jabatan }}</td>
                                        <td>{{ isset($pgw->email) ? $pgw->email : '-' }}</td>
                                        <td class="text-center">
                                            @if ($pgw->status_anggota == 1)
                                                <button type="button"
                                                    class="btn btn-success btn-sm text-white">Aktif</button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm text-white">Tidak
                                                    Aktif</button>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="data-keuangan-pegawai-{{ $pgw->nip }}"><button
                                                            type="button" class="btn btn-sm mb-1 btn-primary"><i
                                                                class="bi bi-eye"></i> Lihat</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        {{-- input date range --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tanggal</span>
                            </div>
                            <input type="date" id="date-awal" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tanggal</span>
                            </div>
                            <input type="date"id="date-akhir" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">User</span>
                            </div>
                            <select name="user_filter" id="user_filter" class="form-control select2">
                                <option value="all">Semua User</option>
                                @foreach ($pegawai as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tipe Jadwal</span>
                            </div>
                            <select class="form-control" id="tipe_jadwal" name="tipe_jadwal">
                                <option value="all" selected>Semua Tipe jadwal</option>
                                <option value="1">Mengajar</option>
                                <option value="2">Perjalanan Dinas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="myFunction()" class="btn btn-primary">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                // dom: 'Bfrtip',
                destroy: true,
                // buttons: [{
                //     extend: 'excelHtml5',
                //     text: 'Export to Excel',
                //     title: 'Data Export',
                //     exportOptions: {
                //         columns: ':not(:last-child)',
                //     }
                // }]
            });
        });

        function myFunction() {
            var date_awal = document.getElementById('date-awal').value;
            var date_akhir = document.getElementById('date-akhir').value;
            var user = document.getElementById('user_filter').value;
            var type = document.getElementById('tipe_jadwal').value;
            if (date_awal && date_akhir && user && type) {
                window.open('/keuangan/excel/' + date_awal + '/' + date_akhir + '/' + user + '/' + type, '_blank');
            }
            // window.location.href = `{{ url('top-risk/excel/') }}` + "/" + x + "/" + y;

        }
    </script>
@endsection
