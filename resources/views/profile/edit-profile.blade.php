@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h4 class="mx-3"> Edit Profile </h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    @can('admin')
                        <div class="form-validation">
                            <form class="form-validate" action="profile.{{ $user->id }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="form-group form-input text-center">
                                    <label for="profileImage">Profile Image</label>
                                    <div class="col-md-12 col-lg-12">
                                        <img id="imgProfil" height="181"
                                            src="{{ file_exists($user->picture) ? url($user->picture) : url('images/user/user.png') }}"
                                            alt="Profile">

                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="text-center mt-2">
                                            <a href="#" class="btn btn-primary " title="Ganti profil image"
                                                onclick="chooseImg()">
                                                <i class="bi bi-image"></i> Upload Profile
                                            </a>
                                            <input type="file" name="imgFile" id="imgFile" style="display:none"
                                                accept='image/*' onchange="previewImg(this)" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nip">NIP <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" placeholder="Masukan NIP Pengajar.."
                                            value="{{ old('nip', $user->nip) }}" required>
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
                                            value="{{ old('name', $user->name) }}" required>
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
                                        {{-- <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            id="jabatan" name="jabatan" placeholder="Masukan Nama Pengajar.."
                                            value="{{ old('jabatan', $user->jabatan) }}"> --}}
                                        <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                            name="jabatan" required>
                                            <optgroup label="Golongan IV">
                                                <option value="Pembina Utama IV-e"
                                                    @if (old('jabatan', $user->jabatan) == 'Pembina Utama IV-e') selected @endif>Pembina Utama IV-e
                                                </option>
                                                <option value="Pembina utama Muda IV-c"
                                                    {{ old('jabatan', $user->jabatan) == 'Pembina utama Muda IV-c' ? 'selected' : '' }}>
                                                    Pembina utama Muda IV-c
                                                </option>
                                                <option value="Pembina Tingkat I IV-b"
                                                    @if (old('jabatan', $user->jabatan) == 'Pembina Tingkat I IV-b') selected @endif>Pembina Tingkat I IV-b
                                                </option>
                                                <option value="Pembina IV-a" @if (old('jabatan', $user->jabatan) == 'Pembina IV-a') selected @endif>
                                                    Pembina IV-a</option>
                                            </optgroup>
                                            <optgroup label="Golongan III">
                                                <option value="Penata Tingkat I III-d"
                                                    @if (old('jabatan', $user->jabatan) == 'Penata Tingkat I III-d') selected @endif>Penata Tingkat I III-d
                                                </option>
                                                <option value="Penata III-c" @if (old('jabatan', $user->jabatan) == 'Penata III-c') selected @endif>
                                                    Penata III-c</option>
                                                <option value="Penata Muda Tingkat I III-b"
                                                    @if (old('jabatan', $user->jabatan) == 'Penata Muda Tingkat I III-b') selected @endif>Penata Muda Tingkat I
                                                    III-b</option>
                                                <option value="Penata Muda III-a"
                                                    @if (old('jabatan', $user->jabatan) == 'Penata Muda III-a') selected @endif>Penata Muda III-a
                                                </option>
                                            </optgroup>
                                            <optgroup label="Golongan II">
                                                <option value="Pengatur Tingkat I II-d"
                                                    @if (old('jabatan', $user->jabatan) == 'Pengatur Tingkat I II-d') selected @endif>Pengatur Tingkat I II-d
                                                </option>
                                                <option value="Pengatur II-c"
                                                    @if (old('jabatan', $user->jabatan) == 'Pengatur II-c') selected @endif>Pengatur II-c</option>
                                                <option value="Pengatur Muda II-b"
                                                    @if (old('jabatan', $user->jabatan) == 'Pengatur Muda II-b') selected @endif>Pengatur Muda II-b
                                                </option>
                                                <option value="Pengatur Muda II-a"
                                                    @if (old('jabatan', $user->jabatan) == 'Pengatur Muda II-a') selected @endif>Pengatur Muda II-a
                                                </option>
                                            </optgroup>
                                            <optgroup label="Golongan I">
                                                <option value="Juru Tingkat I I-d"
                                                    @if (old('jabatan', $user->jabatan) == 'Juru Tingkat I I-d') selected @endif>Juru Tingkat I I-d
                                                </option>
                                                <option value="Juru I-c" @if (old('jabatan', $user->jabatan) == 'Juru I-c') selected @endif>
                                                    Juru I-c</option>
                                                <option value="Juru Muda Tingkat I I-b"
                                                    @if (old('jabatan', $user->jabatan) == 'Juru Muda Tingkat I I-b') selected @endif>Juru Muda Tingkat I I-b
                                                </option>
                                                <option value="Juru Muda I-a"
                                                    @if (old('jabatan', $user->jabatan) == 'Juru Muda I-a') selected @endif>Juru Muda I-a</option>
                                            </optgroup>
                                        </select>
                                        @error('jabatan')
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
                            <form class="form-validate" action="profile.{{ $user->id }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="form-group form-input text-center">
                                    <label for="profileImage">Profile Image</label>
                                    <div class="col-md-12 col-lg-12">
                                        <img id="imgProfil" height="181"
                                            src="{{ file_exists($user->picture) ? url($user->picture) : url('images/user/user.png') }}"
                                            alt="Profile">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="text-center mt-2">
                                                <a href="#" class="btn btn-primary " title="Ganti profil image"
                                                    onclick="chooseImg()">
                                                    <i class="bi bi-image"></i> Upload Profile
                                                </a>
                                                <input type="file" name="imgFile" id="imgFile" style="display:none"
                                                    accept='image/*' onchange="previewImg(this)" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@section('page_script')
    <script>
        function chooseImg() {
            document.getElementById('imgFile').click();
        }

        function previewImg(obj) {
            document.getElementById('imgProfil').src = URL.createObjectURL(obj.files[0]);
        }

        let elemento = document.querySelectorAll(".msg")
        elemento.forEach(e => e.dataset.text = e.textContent)
    </script>
@endsection
