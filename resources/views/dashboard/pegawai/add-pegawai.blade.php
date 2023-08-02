@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h4 class="mx-3">Tambah Pegawai</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="/add-pegawai" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-input">
                                <label for="profileImage">Profile Image</label>
                                <div class="col-md-2 col-lg-2 ml-3 d-flex justify-content-center">
                                    <img id="imgProfil" height="181" src="{{ url('images/user/user.png') }}"
                                        alt="Profile">
                                    <div class="text-center pt-1 ml-3">
                                        <a href="#" class="btn btn-primary " title="Ganti profil image"
                                            onclick="chooseImg()">
                                            <i class="bi bi-image"></i>
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
                                        id="np" name="nip" placeholder="Masukan NIP Pegawai.."
                                        value="{{ old('nip') }}">
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
                                        id="name" name="name" placeholder="Masukan Nama Pegawai.."
                                        value="{{ old('name') }}">
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
                                        id="email" name="email" placeholder="Masukan Email Pegawai.."
                                        value="{{ old('email') }}">
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
                                    {{-- <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                        id="jabatan" name="jabatan" placeholder="Masukan Jabatan.."
                                        value="{{ old('jabatan') }}"> --}}
                                    <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                        name="jabatan">
                                        <optgroup label="Golongan IV">
                                            <option value="Pembina Utama IV-e">Pembina Utama IV-e
                                            </option>
                                            <option value="Pembina utama Muda IV-c">Pembina utama Muda IV-c</option>
                                            <option value="Pembina Tingkat I IV-b">Pembina Tingkat I IV-b</option>
                                            <option value="Pembina IV-a">Pembina IV-a</option>
                                        </optgroup>
                                        <optgroup label="Golongan III">
                                            <option value="Penata Tingkat I III-d">Penata Tingkat I III-d</option>
                                            <option value="Penata III-c">Penata III-c</option>
                                            <option value="Penata Muda Tingkat I III-b">Penata Muda Tingkat I III-b</option>
                                            <option value="Penata Muda III-a">Penata Muda III-a</option>
                                        </optgroup>
                                        <optgroup label="Golongan II">
                                            <option value="Pengatur Tingkat I II-d">Pengatur Tingkat I II-d</option>
                                            <option value="Pengatur II-c">Pengatur II-c</option>
                                            <option value="Pengatur Muda II-b">Pengatur Muda II-b</option>
                                            <option value="Pengatur Muda II-a">Pengatur Muda II-a</option>
                                        </optgroup>
                                        <optgroup label="Golongan I">
                                            <option value="Juru Tingkat I I-d">Juru Tingkat I I-d</option>
                                            <option value="Juru I-c">Juru I-c</option>
                                            <option value="Juru Muda Tingkat I I-b">Juru Muda Tingkat I I-b</option>
                                            <option value="Juru Muda I-a">Juru Muda I-a</option>
                                        </optgroup>
                                    </select>
                                    @error('jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="golongan_id">Pangkat <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control @error('golongan_id') is-invalid @enderror" id="golongan_id"
                                        name="golongan_id">
                                        @foreach ($golongan as $gol)
                                            @if (old('golongan_id') == $gol->id)
                                                <option value="{{ $gol->id }}" selected>{{ $gol->nama_pangkat }} -
                                                    {{ $gol->jenis_golongan }} / {{ $gol->ruang }}</option>
                                            @else
                                                <option value="{{ $gol->id }}">{{ $gol->nama_pangkat }} -
                                                    {{ $gol->jenis_golongan }} / {{ $gol->ruang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="level">Level <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="level" name="level">
                                        <option value="Admin">
                                            Admin
                                        </option>
                                        <option value="User">
                                            User
                                        </option>
                                        <option value="Keuangan">
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
                                        id="phone" name="phone" placeholder="Masukan No HP Pegawai.."
                                        value="{{ old('phone') }}">
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
