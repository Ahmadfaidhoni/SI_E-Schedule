@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="card-title">Data Golongan</h4>
        <div class="card">
            <div class="card-body">

                @if(session()->has('success'))
                <div class="alert alert-success my-3 mx-4 col-lg-8">
                    {{ session('success') }}
                </div>
                @endif

                <div class="mx-4">
                    <a href="/add-golongan"><button type="button" class="btn btn-info"><i class="bi bi-bookmark-plus"></i> Tambah Golongan</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pangkat</th>
                                <th>Gol./Ruang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($golongan as $gol)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gol->nama_pangkat }}</td>
                                <td>{{ $gol->jenis_golongan }} / {{ $gol->ruang }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="editGolongan-{{ $gol->nama_pangkat }}"><button type="button" class="btn btn-sm mb-1 btn-warning text-white"><i class="bi bi-pencil-square"></i> Edit</button></a>
                                            <form action="data-golongan.{{ $gol->id }}" method="post" class="d-inline" onclick="return confirm('Apakah anda yakin ingin menghapus golongan ini?');">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm mb-1 btn-danger"><i class="bi bi-trash"></i> Hapus</button>
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