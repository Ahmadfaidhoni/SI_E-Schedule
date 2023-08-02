@extends('layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <h4 class="mx-3"> Tambah Kegiatan </h4>
        <div class="card mt-3 mx-3">
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-valide" action="/add-kegiatan" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="kode_kegiatan">Kode Kegiatan <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('kode_kegiatan') is-invalid @enderror" id="kode_kegiatan" name="kode_kegiatan" placeholder="Masukan Kode Kegiatan.." value="{{ old('kode_kegiatan') }}" required>
                                @error('kode_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama_kegiatan">Nama Kegiatan <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukan Nama Kegiatan.." value="{{ old('nama_kegiatan') }}" required>
                                @error('nama_kegiatan')
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