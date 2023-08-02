<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kegiatan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawai = User::all()->count();
        $kegiatan = Kegiatan::all()->count();
        $ruangan = Ruangan::all()->count();

        $perubahan = Jadwal::where('user_id', Auth::user()->id)->where('request', '!=', 0)->count();
        $all_perubahan = Jadwal::where('request', '!=', 0)->count();


        $jadwal_pribadi = Jadwal::where('user_id', Auth::user()->id)
            ->select('k.id as kid', 'jadwals.*', 'k.biaya')
            ->leftjoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
            ->where('request', false)
            ->whereRaw("DATE(waktu_mulai) = CURDATE()")
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $jadwal_next_from_today = Jadwal::where('user_id', Auth::user()->id)
            ->select('k.id as kid', 'jadwals.*')
            ->leftJoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
            ->whereRaw("DATE(waktu_mulai) > CURDATE()")
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $all_jadwal_next_from_today = Jadwal::select('k.id as kid', 'jadwals.*')
            ->leftJoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
            ->whereRaw("DATE(waktu_mulai) > CURDATE()")
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $akumulasi_biaya = Jadwal::where('user_id', Auth::user()->id)
            ->select('k.id as kid', 'jadwals.*', 'k.biaya')
            ->leftJoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
            ->whereRaw("YEAR(waktu_mulai) = YEAR(CURDATE()) AND MONTH(waktu_mulai) = MONTH(CURDATE())")
            ->orderBy('waktu_mulai', 'ASC')
            ->pluck('biaya')
            ->sum();

        $jadwal_semua = Jadwal::where('request', false)
            ->select('k.id as kid', 'jadwals.*', 'k.biaya')
            ->leftJoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
            ->whereRaw("DATE(waktu_mulai) = CURDATE()")
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $active_menu = 'dashboard';


        return view('dashboard.dashboard', compact(
            'pegawai',
            'kegiatan',
            'ruangan',
            'perubahan',
            'jadwal_pribadi',
            'jadwal_semua',
            'active_menu',
            'akumulasi_biaya',
            'jadwal_next_from_today',
            'all_jadwal_next_from_today',
            'all_perubahan'
        ));
    }
}
