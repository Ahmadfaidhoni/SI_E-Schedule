@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3"> Detail Pegawai {{ $user->name }} </h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    <div class="mb-5">
                        <div class="float-right">
                            <ul class="list-inline mb-3">
                                <li class="list-inline-item">
                                    <a href="editPegawai-{{ $user->nip }}">
                                        <button type="button" class="btn btn-warning btn-sm"><i
                                                class="bi bi-pencil-square"></i> Edit Data</button>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn btn-danger btn-sm" onclick="reset()"><i
                                            class="bi bi-wrench-adjustable"></i>
                                        Reset Password</button>
                                </li>
                                <li class="list-inline-item">
                                    <form action="data-pegawai.{{ $user->id }}" method="post" id="hapus-form">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus()"><i
                                                class="bi bi-trash"></i>
                                            Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center">
                        <img id="imgProfil" height="181" class="mb-4 rounded-circle"
                            src="{{ file_exists($user->picture) ? url($user->picture) : url('images/user/user.png') }}"
                            alt="Profile">
                    </div>
                    <table class="table table-profile">
                        <tbody>
                            <tr>
                                <th scope="row">NIP:</th>
                                <td>{{ $user->nip }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jabatan:</th>
                                <td>{{ $user->jabatan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail:</th>
                                <td>{{ isset($user->email) ? $user->email : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone:</th>
                                <td>{{ isset($user->phone) ? $user->phone : '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status Anggota</th>
                                <td>
                                    @if ($user->status_anggota == 1)
                                        <button type="button" class="btn btn-success btn-sm text-white"
                                            style="pointer-events: none;">Aktif</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            style="pointer-events: none;">Tidak Aktif</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Roles:</th>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm text-white"
                                        style="pointer-events: none;">{{ $user->level }}</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jadwal:</th>
                                <td>
                                    <a href="jadwal-{{ $user->nip }}"><button type="button"
                                            class="btn btn-primary btn-sm text-white"><i class="bi bi-calendar2-check"></i>
                                            Lihat Semua Jadwal</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script>
        function reset(event) {
            var id = "{{ $user->id }}";
            Swal.fire({
                title: "Apakah Anda yakin untuk mereset password?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Reset",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/reset-password" + "/" + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Password berhasil di reset!',
                            })
                        }
                    })
                }

            });
        }

        function hapus() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Menghapus pegawai ini akan menghapus jadwalnya juga!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-form').submit();
                }
            })
        }
    </script>
@endsection
