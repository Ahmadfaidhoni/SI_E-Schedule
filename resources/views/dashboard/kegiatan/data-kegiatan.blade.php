@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Data Kegiatan</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="">
                        <a href="/add-kegiatan"><button type="button" class="btn btn-primary"><i
                                    class="bi bi-bookmark-plus"></i> Tambah Kegiatan</button></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kegiatan</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $keg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $keg->kode_kegiatan }}</td>
                                        <td>{{ $keg->nama_kegiatan }}</td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-lg-12">
                                                    <a href="editKegiatan-{{ $keg->kode_kegiatan }}"><button type="button"
                                                            class="btn btn-sm mb-1 btn-warning"><i
                                                                class="bi bi-pencil-square"></i>
                                                            Edit</button></a>
                                                    <form method="post" class="d-inline" id="hapus-form">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="btn btn-sm mb-1 btn-danger"
                                                            onclick="hapus({{ $keg->id }})"><i
                                                                class="bi bi-trash"></i>Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
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
        function hapus(id) {

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus Kegiatan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-form').attr('action', '/data-kegiatan/' + id);
                    $('#hapus-form').submit();
                }
            })
        }
    </script>
@endsection
