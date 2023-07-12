@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="card-header">Data Ruangan</h4>
                <div class="card-body">

                    @if (session()->has('success'))
                        <div class="alert alert-success my-3 mx-4 col-lg-8">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mx-4">
                        <a href="/add-ruangan"><button type="button" class="btn btn-info"><i class="bi bi-bookmark-plus"></i>
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="editRuangan-{{ $rng->id }}"><button type="button"
                                                            class="btn btn-sm mb-1 btn-warning text-white"><i
                                                                class="bi bi-pencil-square"></i> Edit</button></a>
                                                    {{-- <form action="data-ruangan.{{ $rng->id }}" method="post"
                                                        class="d-inline"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus Ruangan ini?');">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm mb-1 btn-danger"><i
                                                                class="bi bi-trash"></i> Hapus</button>
                                                    </form> --}}
                                                    <form action="data-ruangan.{{ $rng->id }}" method="post"
                                                        class="d-inline" onsubmit="return confirmDelete(event)">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm mb-1 btn-danger"><i
                                                                class="bi bi-trash"></i> Hapus</button>
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
@section('page_script')
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                title: "Apakah Anda yakin ingin menghapus Ruangan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
@endsection
