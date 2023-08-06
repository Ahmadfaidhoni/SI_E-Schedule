@extends('layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <h4 class="mx-3"> Tambah Ruangan </h4>
        <div class="card mt-3 mx-3">
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-valide" action="/add-ruangan" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="ruangan">Nama Ruangan
                                <span class="text-danger">*</span>
                            </label>
                            <div id="form_ruangan" class="col-md-6">
                                <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror"
                                    placeholder="Masukkan Ruangan..." id="ruangan" name="nama_ruangan"
                                    value="{{ old('ruangan') }}" required>
                                @error('nama_ruangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kapasitas" class="col-lg-4 col-form-label">Kapasitas
                                <span class="text-danger">*</span>
                            </label>
                            <div id="form_kapasitas" class="col-md-6">
                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                    placeholder="Masukkan Kapasitas..." id="kapasitas" name="kapasitas"
                                    value="{{ old('kapasitas') }}" required>
                                @error('kapasitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gedung" class="col-lg-4 col-form-label">Nama Gedung
                                <span class="text-danger">*</span>
                            </label>
                            <div id="form_gedung" class="col-md-6">
                                <input type="text" class="form-control @error('gedung') is-invalid @enderror"
                                    placeholder="Masukkan Gedung..." id="gedung" name="gedung"
                                    value="{{ old('gedung') }}" required>
                                @error('gedung')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama_kegiatan">Nama Lantai
                                <span class="text-danger">*</span>
                            </label>
                            <div id="form_lantai" class="col-md-6">
                                <input type="text" class="form-control @error('lantai') is-invalid @enderror"
                                    placeholder="Masukkan Lantai..." id="lantai" name="lantai"
                                    value="{{ old('lantai') }}" required>
                                @error('lantai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
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
