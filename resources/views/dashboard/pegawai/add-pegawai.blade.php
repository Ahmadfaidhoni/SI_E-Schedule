@extends('layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-valide" action="/add-pegawai" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nip">NIP <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="np" name="nip" placeholder="Masukan NIP Pegawai.." value="{{ old('nip') }}">
                                @error('nip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Nama <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama Pegawai.." value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan Email Pegawai.." value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="jabatan">Jabatan <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" placeholder="Masukan Jabatan.." value="{{ old('jabatan') }}">
                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="golongan_id">Pangkat <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control @error('golongan_id') is-invalid @enderror" id="golongan_id" name="golongan_id">
                                    @foreach($golongan as $gol)
                                        @if(old('golongan_id') == $gol->id)
                                            <option value="{{ $gol->id }}" selected>{{ $gol->nama_pangkat }} - {{ $gol->jenis_golongan }} / {{ $gol->ruang }}</option>
                                        @else
                                            <option value="{{ $gol->id }}">{{ $gol->nama_pangkat }} - {{ $gol->jenis_golongan }} / {{ $gol->ruang }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="level">Level <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control" id="level" name="level">
                                    <option value="Admin">
                                        Admin
                                    </option>
                                    <option value="User">
                                        User
                                    </option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="phone">No HP</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Masukan No HP Pegawai.." value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection