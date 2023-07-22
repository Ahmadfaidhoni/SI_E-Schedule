@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="data-pegawai.{{ $pegawai->id }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="nip">NIP <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                        id="nip" name="nip" placeholder="Masukan NIP Pengajar.."
                                        value="{{ old('nip', $pegawai->nip) }}">
                                    @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="name">Nama <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan Nama Pengajar.."
                                        value="{{ old('name', $pegawai->name) }}">
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
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukan Email Pengajar.."
                                        value="{{ old('email', $pegawai->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="jabatan">Jabatan <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                        id="jabatan" name="jabatan" placeholder="Masukan Jabatan.."
                                        value="{{ old('jabatan', $pegawai->jabatan) }}">
                                    @error('jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="golongan">Gol. Ruang <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control @error('golongan_id') is-invalid @enderror" id="golongan_id" name="golongan_id">
                                    <option value="{{ old('golongan_id', $pegawai->golongan_id) }}" selected disabled>{{ isset($pegawai->golongan)?$pegawai->golongan->nama_pangkat:'- ' }} - {{ isset($pegawai->golongan)?$pegawai->golongan->jenis_golongan:'- ' }}/{{ isset($pegawai->golongan)?$pegawai->golongan->ruang:' -' }}</option>
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->id }}">{{ $gol->nama_pangkat }} - {{ $gol->jenis_golongan }}/{{ $gol->ruang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="status_anggota">Status <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="status_anggota" name="status_anggota">
                                        <option value="1"
                                            {{ old('status_anggota', $pegawai->status_anggota) == 1 ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="0"
                                            {{ old('status_anggota', $pegawai->status_anggota) == 0 ? 'selected' : '' }}>
                                            Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="level">Level <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="level" name="level">
                                        <option value="Admin"
                                            {{ old('level', $pegawai->level) == 'Admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="User"
                                            {{ old('level', $pegawai->level) == 'User' ? 'selected' : '' }}>
                                            User
                                        </option>
                                        <option value="Keuangan"
                                            {{ old('level', $pegawai->level) == 'Keuangan' ? 'selected' : '' }}>
                                            Keuangan
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
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Masukan No HP Pengajar.."
                                        value="{{ old('phone', $pegawai->phone) }}">
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
