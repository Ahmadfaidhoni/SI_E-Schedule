<?php

namespace App\Http\Controllers;

use App\Mail\NotifAccJadwal;
use App\Mail\NotifAdmin;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Mail\NotifEditJadwal;
use App\Mail\NotifTolak;
use App\Models\HistoryPerubahanJadwal;
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
                'jadwal' => Jadwal::where('user_id', Auth::user()->id)->where('request', true)->get()
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
        if (Auth::id() == $jadwal->user_id) {
            $validatedData = $request->validate([
                'alasan' => 'required',
            ]);

            $validatedData['request'] = 1;

            Jadwal::where('id', $jadwal->id)->update($validatedData);

            $getIdUser = $jadwal['user_id'];

            // $getEmail = User::find($getIdUser)->email;
            $emailAdmin = User::where('level', 'Admin')->where('email', '!=', null)->get();

            // $arr_email = [];
            // foreach ($emailAdmin as $item) {
            //     $arr_email[] = $item->email;
            // }

            // if ($getEmail != null) {
            //     Mail::to($getEmail)->send(new NotifEditJadwal($validatedData));

            //     if ($arr_email != null) {
            //         Mail::to($arr_email)->send(new NotifAdmin($validatedData));
            //     }
            // } else {
            //     if ($arr_email != null) {
            //         Mail::to($arr_email)->send(new NotifAdmin($validatedData));
            //     }
            // }

            Alert::success('Congrats', 'Permintaan Berhasil Terkirim!');
            return redirect('/perubahan-jadwal');
        } else {
            return abort(403);
        }
    }

    // public function AccRequest(Jadwal $jadwal)
    // {
    //     $data = [];
    //     $data['request'] = false;
    //     $data['alasan'] = null;
    //     $data['waktu_mulai'] = $jadwal['req_mulai'];
    //     $data['waktu_selesai'] = $jadwal['req_selesai'];

    //     Jadwal::where('id', $jadwal->id)->update($data);

    //     $getIdUser = $jadwal['user_id'];

    //     $getEmail = User::find($getIdUser)->email;

    //     if($getEmail != null){
    //         Mail::to($getEmail)->send(new NotifAccJadwal($data));
    //     }

    //     Alert::success('Congrats', 'Jadwal Berhasil Diatur!');
    //     return redirect('/');
    //     // return redirect('/')->with('success', 'Permintaan Berhasil Terkirim.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        Jadwal::destroy($jadwal->id);

        Alert::success('Congrats', 'Jadwal Berhasil dihapus!');
        return redirect('/');
        // return redirect('/')->with('success', 'Jadwal Berhasil dihapus.');
    }

    public function tolakJadwal(Jadwal $jadwal)
    {
        $data = [];
        $data['request'] = false;
        $data['alasan'] = null;

        Jadwal::where('id', $jadwal->id)->update($data);

        $getIdUser = $jadwal->user_id;

        $getEmail = User::find($getIdUser)->email;

        // if ($getEmail != null) {
        //     Mail::to($getEmail)->send(new NotifTolak($data));
        // }

        Alert::success('Congrats', 'Jadwal ditolak!');
        return redirect('/perubahan-jadwal');
        // return redirect('/perubahan-jadwal')->with('success', 'Jadwal Ditolak.');
    }
}
