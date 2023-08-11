@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="mx-3">Data Ruangan</h4>
        <div class="card mt-3 mx-3">
            <div class="card-body">
                <div class="">
                    <a href="/add-ruangan"><button type="button" class="btn btn-primary"><i class="fa fa-building"></i>
                            Tambah Ruangan</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Kapasitas</th>
                                <th>Gedung</th>
                                <th>Lantai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ruangan as $rng)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rng->nama_ruangan }}</td>
                                    <td>{{ $rng->kapasitas }}</td>
                                    <td>{{ $rng->gedung }}</td>
                                    <td>{{ $rng->lantai }}</td>
                                    <td>
                                        <div class="row text-center">
                                            <div class="col-lg-12">
                                                <a href="editRuangan-{{ $rng->id }}"><button type="button"
                                                        class="btn btn-sm mb-1 btn-warning"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</button></a>
                                                <form method="post" class="d-inline"
                                                    id="hapus-form">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-sm mb-1 btn-danger"
                                                        onclick="hapus({{ $rng->id }})"><i class="bi bi-trash"></i> Hapus</button>
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
@endsection
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apakah anda yakin ingin menghapus Ruangan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#hapus-form').attr('action', '/data-ruangan/' + id);
                $('#hapus-form').submit();
            }
        })
    }

</script>
