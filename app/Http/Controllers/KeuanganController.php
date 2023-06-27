<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\User;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('keuangan.data-pegawai-keuangan', [
            "pegawai" => User::where('id', '!=', '1')->orderBy('name', 'ASC')->get()
        ]);
    }

    public function show(User $user)
    {
        $keuangan = Keuangan::join('jadwals', 'keuangans.jadwal_id', '=', 'jadwals.id')
            ->leftJoin('kegiatans', 'jadwals.kegiatan_id', '=', 'kegiatans.id')
            ->where('jadwals.user_id', $user->id)
            ->get();
        return view('keuangan.show-pegawai-keuangan', [
            "user" => $user,
            "keuangan" => $keuangan
        ]);
    }
}
