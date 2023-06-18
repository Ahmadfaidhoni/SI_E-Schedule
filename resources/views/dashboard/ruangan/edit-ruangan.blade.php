@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="data-ruangan.{{ $ruangan->id }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="row form-material">
                                <div id="form_ruangan" class="col-md-4 mt-2">
                                    <label for="ruangan" class="m-t-20">Ruangan </label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror"
                                        placeholder="ruangan" id="ruangan" name="nama_ruangan"
                                        value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}">
                                    @error('nama_ruangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_kapasitas" class="col-md-4 mt-2">
                                    <label for="kapasitas" class="m-t-20">Kapasitas </label> <span
                                        class="text-danger">*</span>
                                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                        placeholder="Masukkan Kapasitas..." id="kapasitas" name="kapasitas"
                                        value="{{ old('kapasitas', $ruangan->kapasitas) }}">
                                    @error('kapasitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_gedung" class="col-md-4 mt-2">
                                    <label for="gedung" class="m-t-20">Nama Gedung </label> <span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control @error('gedung') is-invalid @enderror"
                                        placeholder="Masukkan Gedung..." id="gedung" name="gedung"
                                        value="{{ old('gedung', $ruangan->gedung) }}">
                                    @error('gedung')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_lantai" class="col-md-4 mt-2">
                                    <label for="lantai" class="m-t-20">Nama Lantai </label> <span
                                        class="text-danger">*</span>
                                    <input type="text" class="form-control @error('lantai') is-invalid @enderror"
                                        placeholder="Masukkan Lantai..." id="lantai" name="lantai"
                                        value="{{ old('lantai', $ruangan->lantai) }}">
                                    @error('lantai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_submit" class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
