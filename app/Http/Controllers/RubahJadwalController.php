<?php

namespace App\Http\Controllers;

use App\Mail\NotifAccJadwal;
use App\Mail\NotifAdmin;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Mail\NotifEditJadwal;
use App\Mail\NotifTolak;
use App\Models\Keuangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class RubahJadwalController extends Controller
{
    public function index()
    {
        $active_menu = 'perubahan-jadwal';
        if (auth()->user()->level === "Admin") {
            return view('dashboard.rubah-jadwal.perubahan-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::where('request', true)->get()
            ]);
        } else {
            return view('dashboard.rubah-jadwal.perubahan-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::where('user_id', Auth::user()->id)->where('request', true)->get(),
                'keuangan' => Keuangan::where('jadwal_id', Auth::user()->id)->first(),
            ]);
        }
    }

    // public function history_perubahan()
    // {
    //     $active_menu = 'perubahan-jadwal';
    //     $perubahan_jadwal = HistoryPerubahanJadwal::get();
    //     return view('dashboard.rubah-jadwal.history-perubahan-jadwal', compact('active_menu'), [
    //         'jadwal' => $perubahan_jadwal
    //     ]);
    // }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        $active_menu = 'perubahan-jadwal';
        return view('dashboard.rubah-jadwal.show-ubah-jadwal', compact('active_menu'), [
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $active_menu = 'perubahan-jadwal';
        return view('dashboard.rubah-jadwal.edit-jadwal', compact('active_menu'), [
            "kegiatan" => Kegiatan::all(),
            "pegawai" => User::all(),
            "jadwal" => $jadwal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $checkTipeJadwal = $jadwal->tipe_jadwal;

        if (Auth::id() == $jadwal->user_id) {
            $validatedData = $request->validate([
                'alasan' => 'required',
            ]);

            $validatedData['request'] = 1;

            Jadwal::where('id', $jadwal->id)->update($validatedData);

            // get validate
            $getIdUser = $jadwal['user_id'];
            $getEmail = User::find($getIdUser)->email;
            $emailAdmin = User::where('level', 'Admin')->where('email', '!=', null)->get();
            $getEmailAdmin = [];

            foreach ($emailAdmin as $item) {
                $getEmailAdmin[] = $item->email;
            }

            // send validate
            $validatedData['username'] = User::find($getIdUser)->name;
            $validatedData['waktu_mulai'] = $jadwal['waktu_mulai'];
            $validatedData['waktu_selesai'] = $jadwal['waktu_selesai'];
            $validatedData['keterangan'] = $jadwal['keterangan'];
            $validatedData['tipe_jadwal'] = $jadwal['tipe_jadwal'];

            if ($checkTipeJadwal == 1) {
                $validatedData['ruangan'] = Ruangan::find($jadwal['ruangan_id'])->nama_ruangan ?? '-';
                $validatedData['kegiatan'] = Kegiatan::find($jadwal['kegiatan_id'])->nama_kegiatan ?? '-';
            }

            // kirim email
            if ($getEmail != null) {
                Mail::to($getEmail)->send(new NotifEditJadwal($validatedData));
            }

            if ($getEmailAdmin != null) {
                Mail::to($getEmailAdmin)->send(new NotifAdmin($validatedData));
            }

            Alert::success('Congrats', 'Permintaan Berhasil Terkirim!');
            return redirect('/perubahan-jadwal');
        } else {
            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
    }

    public function tolakJadwal($id)
    {
        $jadwal = Jadwal::find($id);
        $checkTipeJadwal = $jadwal->tipe_jadwal;
        $getAlasan = $jadwal->alasan;

        $data = [];
        $data['request'] = false;
        $data['alasan'] = null;

        $jadwal->update($data);
        // Jadwal::where('id', $jadwal->id)->update($data);

        // get validate
        $getIdUser = $jadwal['user_id'];
        $getEmail = User::find($getIdUser)->email;

        // send validate
        $data['username'] = User::find($getIdUser)->name;
        $data['waktu_mulai'] = $jadwal['waktu_mulai'];
        $data['waktu_selesai'] = $jadwal['waktu_selesai'];
        $data['keterangan'] = $jadwal['keterangan'];
        $data['tipe_jadwal'] = $jadwal['tipe_jadwal'];
        $data['alasan'] = $jadwal['alasan'];

        if ($checkTipeJadwal == 1) {
            $data['ruangan'] = Ruangan::find($jadwal['ruangan_id'])->nama_ruangan ?? '-';
            $data['kegiatan'] = Kegiatan::find($jadwal['kegiatan_id'])->nama_kegiatan ?? '-';
        }

        // kirim email
        if ($getEmail != null) {
            Mail::to($getEmail)->send(new NotifTolak($data));
        }

        Alert::success('Congrats', 'Jadwal ditolak!');
        return redirect('/perubahan-jadwal');
    }
}
