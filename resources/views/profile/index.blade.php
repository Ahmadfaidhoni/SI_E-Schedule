@extends('layouts.master')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    {{-- @if (session()->has('success'))
        <div class="alert alert-success my-3 mx-2 col-lg-8">
            {{ session('success') }}
</div>
@endif
@if (session()->has('successPassword'))
<div class="alert alert-success my-3 mx-2 col-lg-8">
    {{ session('successPassword') }}
</div>
@endif --}}

    <div class="row justify-content-center">
        <div class="col-12">
            @foreach ($profiles as $profile)
                <h4 class="mx-3"> My Profile </h4>
                <div class="card mt-3 mx-3">
                    <div class="card-header">
                        <div class="float-right">
                            <a href="editProfile">
                                <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit
                                    Profile</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="rounded-circle mb-5" id="imgProfil" height="181"
                                src="{{ file_exists($profile->picture) ? url($profile->picture) : url('images/user/user.png') }}"
                                alt="Profile">
                        </div>
                        <table class="table table-profile">
                            <tbody>
                                <tr>
                                    <th scope="row">NIP:</th>
                                    <td>{{ $profile->nip }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Name:</th>
                                    <td>{{ $profile->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jabatan:</th>
                                    <td>{{ $profile->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Golongan:</th>
                                    <td>{{ $profile->golongan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail:</th>
                                    <td>{{ isset($profile->email) ? $profile->email : '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone:</th>
                                    <td>{{ isset($profile->phone) ? $profile->phone : '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Anggota:</th>
                                    <td>
                                        @if ($profile->status_anggota == 1)
                                            <button type="button" class="btn btn-success btn-sm text-white"
                                                style="pointer-events: none">Aktif</button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm text-white"
                                                style="pointer-events: none">Tidak Aktif</button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Roles:</th>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm text-white"
                                            style="pointer-events: none">{{ $profile->level }}</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-12 mt-3">
            <h4 class="mx-3"> Change My Password</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-validate" action="{{ route('change.password') }}" method="post">

                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="password">Current Password <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror" id="password"
                                        name="current_password" placeholder="Input Current Password.."
                                        autocomplete="current-password">
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="password">New Password<span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password" placeholder="Input New Password.."
                                        autocomplete="current-password">
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="password">Confirm New Password <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="password"
                                        class="form-control @error('new_confirm_password') is-invalid @enderror"
                                        id="new_confirm_password" name="new_confirm_password"
                                        placeholder="Confirm New Password.." autocomplete="current-password">
                                    @error('new_confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
@endsection
