@extends('...layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h4 class="mx-3">Data Jadwal {{ $jadwal->user->name }}</h4>
            <div class="card mx-3 mt-3">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="data-ubah-jadwal.{{ $jadwal->id }}" method="post"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="row form-material">
                                <div class="col-md-4 mt-4">
                                    <label for="tipe_kegiatan">Tipe Jadwal</label> <span class="text-danger">*</span>
                                    <select class="form-control" id="tipe_jadwal" name="tipe_jadwal" disabled>
                                        @if ($jadwal->kegiatan_id != null)
                                            <option value="1" selected>Mengajar</option>
                                            <option value="2">Perjalanan Dinas</option>
                                        @else
                                            <option value="1">Mengajar</option>
                                            <option value="2" selected>Perjalanan Dinas</option>
                                        @endif
                                    </select>
                                </div>
                                <div id="form_kegiatan" class="col-md-4 mt-4"
                                    style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                                    <label for="kegiatan">Kegiatan</label> <span class="text-danger">*</span>
                                    <select class="form-control" id="kegiatan" name="kegiatan_id" disabled>
                                        @foreach ($kegiatan as $keg)
                                            @if (old('kegiatan_id', $jadwal->kegiatan_id) == $keg->id)
                                                <option value="{{ $keg->id }}" selected>{{ $keg->nama_kegiatan }}
                                                </option>
                                            @else
                                                <option value="{{ $keg->id }}">{{ $keg->nama_kegiatan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="pengajar">Tanggal</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" placeholder="Tanggal Kegiatan"
                                            value="{{ old('waktu_mulai', date('Y-m-d', strtotime($jadwal->waktu_mulai))) }}"
                                            disabled>
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mt-4" style="display:{{ $jadwal->tipe_jadwal == '1' ? 'none' : '' }}">
                                    <label for="pengajar">Tanggal Akhir</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="date"
                                            class="form-control @error('tangga_akhir') is-invalid @enderror"
                                            id="tangga_akhir" name="tangga_akhir" placeholder="Tanggal Akhir Kegiatan"
                                            value="{{ old('waktu_selesai', date('Y-m-d', strtotime($jadwal->waktu_selesai))) }}"
                                            disabled>
                                        @error('tangga_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="form_mulai" class="col-md-4 mt-4"
                                    style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                                    <label for="mulai" class="m-t-20">Jam Mulai</label> <span
                                        class="text-danger">*</span>
                                    <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        id="mulai" name="waktu_mulai" placeholder="Check time"
                                        value="{{ old('waktu_mulai', date('H:i', strtotime($jadwal->waktu_mulai))) }}"
                                        disabled>
                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_selesai" class="col-md-4 mt-4"
                                    style="display:{{ $jadwal->tipe_jadwal == '2' ? 'none' : '' }}">
                                    <label for="selesai" class="m-t-20">Jam Selesai</label> <span
                                        class="text-danger">*</span>
                                    <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        id="selesai" name="waktu_selesai" placeholder="Check time"
                                        value="{{ old('waktu_selesai', date('H:i', strtotime($jadwal->waktu_selesai))) }}"
                                        disabled>
                                    @error('waktu_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_alasan" class="col-md-4 mt-4">
                                    <label for="angkatan" class="m-t-20">Alasan</label> <span class="text-danger">*</span>
                                    {{-- <textarea class="form-control @error('alasan') is-invalid @enderror"
                                    placeholder="Masukkan Alasan Perubahan Jadwal..." id="alasan" name="alasan"
                                    rows="3">{{ old('alasan', $jadwal->alasan) }}</textarea> --}}
                                    <select class="select2 form-control" id="alasan" name="alasan">
                                        <option value="IZIN">IZIN</option>
                                        <option value="SAKIT">SAKIT</option>
                                    </select>
                                    @error('alasan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_alasan" class="col-md-4 mt-4">
                                    <label for="angkatan" class="m-t-20">Dokumen Pendukung</label> <span
                                        class="text-danger">*</span>
                                    <input type="file" class="form-control @error('file_alasan') is-invalid @enderror"
                                        id="file_alasan" name="file_alasan"
                                        placeholder="Masukkan Alasan Perubahan Jadwal...">
                                    @error('alasan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="form_submit" class="col-12 mt-3">
                                    <button id="btnSubmit" type="submit" class="btn btn-info">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
@endsection
