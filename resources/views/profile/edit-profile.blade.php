@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('admin')
                        <div class="form-validation">
                            <form class="form-validate" action="profile.{{ $user->id }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nip">NIP <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" placeholder="Masukan NIP Pengajar.."
                                            value="{{ old('nip', $user->nip) }}">
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
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
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
                                            id="jabatan" name="jabatan" placeholder="Masukan Nama Pengajar.."
                                            value="{{ old('jabatan', $user->jabatan) }}">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="" class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="golongan_id">Golongan <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control @error('golongan_id') is-invalid @enderror" id="golongan_id"
                                            name="golongan_id">
                                            <option value="{{ old('golongan_id', $user->golongan_id) }}" selected disabled>
                                                {{ isset($user->golongan) ? $user->golongan->nama_pangkat : '- ' }} -
                                                {{ isset($user->golongan) ? $user->golongan->jenis_golongan : '- ' }}/{{ isset($user->golongan) ? $user->golongan->ruang : ' -' }}
                                            </option>
                                            @foreach ($golongan as $gol)
                                                <option value="{{ $gol->id }}">{{ $gol->nama_pangkat }} -
                                                    {{ $gol->jenis_golongan }}/{{ $gol->ruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukan Email Pengajar.."
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
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
                                            value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="roles">Roles <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('level') is-invalid @enderror"
                                            id="level" name="level" placeholder="level.."
                                            value="{{ old('level', $user->level) }}" disabled>
                                        @error('level')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="roles">Status Anggota<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="status_anggota" name="status_anggota">
                                            <option value="1"
                                                {{ old('status_anggota', $user->status_anggota) == 1 ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('status_anggota', $user->status_anggota) == 0 ? 'selected' : '' }}>
                                                Tidak Aktif
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endcan
                    @if (Auth::user()->level == 'User' || Auth::user()->level == 'Keuangan')
                        <div class="form-validation">
                            <form class="form-validate" action="profile.{{ $user->id }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nip">NIP <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" placeholder="Masukan NIP Pengajar.."
                                            value="{{ old('nip', $user->nip) }}" readonly="true">
                                        @error('nip')
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
                                            id="jabatan" name="jabatan" placeholder="Masukan Nama Pengajar.."
                                            value="{{ old('jabatan', $user->jabatan) }}" readonly="true">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="roles">Roles <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('level') is-invalid @enderror"
                                            id="level" name="level" placeholder="level.."
                                            value="{{ old('level', $user->level) }}" readonly="true">
                                        @error('level')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="roles">Status Anggota<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('status_anggota') is-invalid @enderror"
                                            id="status_anggota" name="status_anggota" placeholder="status_anggota.."
                                            value="{{ old('status_anggota', $user->status_anggota) == 1 ? 'Aktif' : 'Tidak Aktif' }}"
                                            disabled>
                                        @error('status_anggota')
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
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukan Email Pengajar.."
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
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
                                            value="{{ old('phone', $user->phone) }}">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
