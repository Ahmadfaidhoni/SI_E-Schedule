<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Mail\NotifEdit;
use App\Models\Kegiatan;
use App\Mail\NotifJadwal;
use Illuminate\Http\Request;
use App\Mail\NotificationEmail;
use App\Models\Config;
use App\Models\Keuangan;
use App\Models\Ruangan;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'jadwal';
        if (auth()->user()->level === "Admin") {
            return view('dashboard.jadwal.data-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::with('ruangan')->where('request', false)->whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) >= curdate())")->orderBy('waktu_mulai', 'ASC')->get()
            ]);
        } else {
            return view('dashboard.jadwal.data-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::where('user_id', Auth::user()->id)->where('request', false)->whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) >= curdate())")->orderBy('waktu_mulai', 'ASC')->get()
            ]);
        }
    }

    public function history()
    {
        if (auth()->user()->level === "Admin") {
            return view('dashboard.jadwal.history-jadwal', [
                'jadwal' => Jadwal::whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) < curdate())")->orderBy('waktu_mulai', 'DESC')->get()
            ]);
        } else {
            return view('dashboard.jadwal.history-jadwal', [
                'jadwal' => Jadwal::where('user_id', Auth::user()->id)->whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) < curdate())")->orderBy('waktu_mulai', 'DESC')->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'jadwal';
        return view('dashboard.jadwal.add-jadwal', compact('active_menu'), [
            "kegiatan" => Kegiatan::all(),
            "pegawai" => User::all(),
            "ruangan" => Ruangan::all(),
            "config_max_jp" => Config::where('key', 'MAX_JP')->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $checkTipeJadwal = $request->tipe_jadwal;
        $config_max_jp = Config::where('key', 'MAX_JP')->first();

        $biaya = null;
        if ($checkTipeJadwal != 1) {
            $validatedData = $request->validate([
                'tipe_jadwal' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'tanggal_akhir' => 'required',
                'keterangan' => '',
            ]);


            $validatedData['kegiatan_id'] = null;
            $validatedData['angkatan'] = null;
            $validatedData['jp'] = $config_max_jp->value ?? 15;
            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " 00:00:00";
            $validatedData['waktu_selesai'] = $validatedData['tanggal_akhir'] . " 23:59:00";

            $biaya = $request->biaya;

            // if (!is_numeric($validatedData['user_id'])) {
            $getUserName = $validatedData['user_id'];
            $getId = User::where('id', $getUserName)->first()->id;

            $validatedData['user_id'] = $getId;
            // }

            $jadwal =  Jadwal::create($validatedData);

            Keuangan::create([
                'jadwal_id' => $jadwal->id,
                'biaya' => $biaya
            ]);
        } else {
            $validatedData = $request->validate([
                'tipe_jadwal' => 'required',
                'kegiatan_id' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'tanggal_akhir' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
                'jp' => 'required',
                'angkatan' => 'required',
                'keterangan' => '',
                'ruangan_id' => ''
            ]);


            $config_biaya = Config::where('key', 'BIAYA_JP')->first();

            $biaya = ($config_biaya->value ?? 45000) * $validatedData['jp'];

            // if (!is_numeric($validatedData['user_id'])) {
            $getUserName = $validatedData['user_id'];
            $getId = User::where('id', $getUserName)->first()->id;

            $validatedData['user_id'] = $getId;
            // }

            $dates = CarbonPeriod::create($validatedData['tanggal'], $validatedData['tanggal_akhir']);
            // dd($dates);
            foreach ($dates as $date) {
                $validatedDataCopy = $validatedData;
                $dateFormatted = $date->format('Y-m-d');
                // dd($date->format('Y-m-d'));
                // $validatedData['tanggal'] = $date->format('Y-m-d');

                $validatedDataCopy['waktu_mulai'] = $dateFormatted . " " . $validatedData['waktu_mulai'];
                $validatedDataCopy['waktu_selesai'] = $dateFormatted  . " " . $validatedData['waktu_selesai'];


                $jadwal = Jadwal::create($validatedDataCopy);

                Keuangan::create([
                    'jadwal_id' => $jadwal->id,
                    'biaya' => $biaya
                ]);
            }
            // $jadwal =  Jadwal::create($validatedData);

            // Keuangan::create([
            //     'jadwal_id' => $jadwal->id,
            //     'biaya' => $biaya
            // ]);
        }

        // unset($validatedData['tanggal']);



        Alert::success('Congrats', 'Jadwal Berhasil dibuat!');

        $getIdUser = $validatedData['user_id'];

        // $getEmail = User::find($getIdUser)->email;

        // if ($getEmail != null) {
        //     Mail::to($getEmail)->send(new NotifJadwal($validatedData));
        // }

        // return redirect('/jadwal');

        return redirect('/jadwal')->with('success', 'Jadwal Berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        // return $jadwal = Jadwal::find($jadwal->id)
        //     ->select('jadwals.id as jadwal_ids', 'k.id as keuangan_id', 'k.biaya')
        //     ->leftjoin('keuangans as k', 'k.jadwal_id', '=', 'jadwals.id')
        //     ->first();

        $jadwal = DB::table('jadwals')
            ->select(
                'jadwals.*',
                'keuangans.id as keuangan_id',
                'keuangans.biaya',
                'users.name as user_name',
                'kegiatans.nama_kegiatan'
            )
            ->leftJoin('keuangans', 'keuangans.jadwal_id', '=', 'jadwals.id')
            ->leftJoin('users', 'users.id', '=', 'jadwals.user_id')
            ->leftJoin('kegiatans', 'kegiatans.id', '=', 'jadwals.kegiatan_id')
            ->where('jadwals.id', $jadwal->id)
            ->first();

        return view('dashboard.jadwal.show-jadwal', [
            'jdwl' => $jadwal
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
        return view('dashboard.jadwal.edit-jadwal', [
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
        $checkTipeJadwal = $request->tipe_jadwal;
        $checkRequest = $jadwal->request;
        $config_max_jp = Config::where('key', 'MAX_JP')->first();


        if ($checkTipeJadwal != 1) {
            $validatedData = $request->validate([
                'tipe_jadwal' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'tanggal_akhir' => 'required',
                'keterangan' => ''
            ]);


            $validatedData['kegiatan_id'] = null;
            $validatedData['angkatan'] = null;
            $validatedData['jp'] = $config_max_jp->value ?? 15;
            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " 00:00:00";
            $validatedData['waktu_selesai'] = $validatedData['tanggal'] . " 23:59:00";
        } else {
            $validatedData = $request->validate([
                'tipe_jadwal' => 'required',
                'kegiatan_id' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'tanggal_akhir' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
                'jp' => 'required',
                'angkatan' => 'required',
                'keterangan' => ''
            ]);

            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " " . $validatedData['waktu_mulai'];
            $validatedData['waktu_selesai'] = $validatedData['tanggal'] . " " . $validatedData['waktu_selesai'];
        }

        unset($validatedData['tanggal']);

        // if (!is_numeric($validatedData['user_id'])) {
        //     $getUserName = $validatedData['user_id'];
        //     $getId = User::where('name', $getUserName)->first()->id;

        //     $validatedData['user_id'] = $getId;
        // }

        $getUserName = $validatedData['user_id'];
        $getId = User::where('id', $getUserName)->first()->id;

        $validatedData['user_id'] = $getId;


        if ($checkRequest == true) {
            $validatedData['request'] = false;
            $validatedData['alasan'] = null;
        }

        $getIdUser = $validatedData['user_id'];

        // $getEmail = User::find($getIdUser)->email;

        // if ($getEmail != null) {
        //     Mail::to($getEmail)->send(new NotifEdit($validatedData));
        // }

        Jadwal::where('id', $jadwal->id)->update($validatedData);

        Alert::success('Congrats', 'Jadwal Berhasil diubah!');
        return redirect('/jadwal');
        // return redirect('/')->with('success', 'Jadwal Berhasil diubah.');
    }

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

    public function showFull(User $user)
    {
        return view('dashboard.jadwal.showfull-jadwal', [
            $user_id = $user->id,
            'user' => $user,
            'jadwal' => Jadwal::where('user_id', $user_id)->orderBy('waktu_mulai', 'DESC')->get()
        ]);
    }

    public function checkJadwal(Request $request)
    {
        $config_max_jp = Config::where('key', 'MAX_JP')->first();
        $limit_max_jp = $config_max_jp->value ?? 15;
        $tanggal_mulai = $request->tanggal . ' ' . $request->mulai;
        $tanggal_selesai = $request->tanggal . ' ' . $request->selesai;
        $ruangan = $request->ruangan;
        $jp = $request->jp;

        // dd($ruangan);

        $arr_user_id = [];

        $bentrok = DB::table('jadwals')
            ->select('user_id', 'ruangan_id')
            ->whereRaw("
            (waktu_mulai <= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i') AND (waktu_selesai - INTERVAL 1 MINUTE) >= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i')) OR
            (waktu_mulai <= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i') AND (waktu_selesai - INTERVAL 1 MINUTE) >= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i')) OR 
            (waktu_mulai >= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i') AND (waktu_selesai - INTERVAL 1 MINUTE) <= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i')) ")
            // ->where('ruangan_id', $ruangan)
            ->get()
            ->toArray();

        // dd($bentrok);  
        $temp = [];
        $all = DB::table('users')->pluck('id');
        // dd($all);
        foreach ($bentrok as $items) {
            // dd($items->ruangan_id);
            if ($items->ruangan_id == $ruangan) {
                $temp[] = $items->user_id;
            }
        }

        if (count($temp) > 0) {
            $temp = $all;
        }

        // dd($temp);
        foreach ($temp as $item) {
            $arr_user_id[] = $item;
        }

        // dd($arr_user_id);

        $max_jp = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("waktu_mulai >= STR_TO_DATE('$request->tanggal 00:00:00', '%Y-%m-%d %H:%i:%s') AND waktu_selesai <= STR_TO_DATE('$request->tanggal 23:59:59', '%Y-%m-%d %H:%i:%s')")
            ->groupBy('user_id')
            ->having(DB::raw("(SUM(jp)+$jp)"), '>', $limit_max_jp)
            ->where('ruangan_id', $ruangan)
            ->get()->toArray();
        foreach ($max_jp as $item) {
            $arr_user_id[] = $item->user_id;
        }

        $checking = DB::table('users')->orderBy('name', 'ASC')->where('status_anggota', true)
            ->whereNotIn('id', $arr_user_id)
            ->get();

        // $select = array(["id" => '', "text" => 'Select Schedule']);
        $select = [];
        foreach ($checking as $item) {
            $select[] = ["id" => $item->id, "text" => $item->name];
        }

        return response()->json(["error" => false, "data" => $select]);

        // echo json_encode([
        //     'data' => $checking,
        //     'debug' => [
        //         'tanggal_mulai' => $tanggal_mulai,
        //         'tanggal_selesai' => $tanggal_selesai,
        //         'arr_user_id' => $arr_user_id,
        //     ]
        // ]);
    }

    public function checkJadwalUpdate(Request $request)
    {
        $config_max_jp = Config::where('key', 'MAX_JP')->first();
        $limit_max_jp = $config_max_jp->value ?? 15;
        $tanggal_mulai = $request->tanggal . ' ' . $request->mulai;
        $tanggal_selesai = $request->tanggal . ' ' . $request->selesai;
        $id = $request->id;
        $jp = $request->jp;

        $arr_user_id = [];
        $bentrok = DB::table('jadwals')->select('user_id')->whereRaw("
        ((waktu_mulai <= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i') AND waktu_selesai >= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i')) OR
        (waktu_mulai <= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i') AND waktu_selesai >= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i')) OR 
        (waktu_mulai >= STR_TO_DATE('$tanggal_mulai', '%Y-%m-%d %H:%i') AND waktu_selesai <= STR_TO_DATE('$tanggal_selesai', '%Y-%m-%d %H:%i'))) 
        AND id != '$id'
        ")->get()->toArray();
        foreach ($bentrok as $item) {
            $arr_user_id[] = $item->user_id;
        }

        $max_jp = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("(waktu_mulai >= STR_TO_DATE('$request->tanggal 00:00:00', '%Y-%m-%d %H:%i:%s') AND waktu_selesai <= STR_TO_DATE('$request->tanggal 23:59:59', '%Y-%m-%d %H:%i:%s')) 
            AND id != '$id'")
            ->groupBy('user_id')
            ->having(DB::raw("(SUM(jp)+$jp)"), '>', $limit_max_jp)
            ->get()->toArray();
        foreach ($max_jp as $item) {
            $arr_user_id[] = $item->user_id;
        }

        // $checking = DB::table('users')->orderBy('name', 'ASC')->where('status_anggota', true)->where('id', '!=', '1')->whereNotIn('id', $arr_user_id)->get();

        // echo json_encode([
        //     'data' => $checking,
        //     'debug' => [
        //         'tanggal_mulai' => $tanggal_mulai,
        //         'tanggal_selesai' => $tanggal_selesai,
        //         'arr_user_id' => $arr_user_id,
        //     ]
        // ]);

        $checking = DB::table('users')->orderBy('name', 'ASC')->where('status_anggota', true)->where('id', '!=', '1')->whereNotIn('id', $arr_user_id)->get();
        $select = [];
        foreach ($checking as $item) {
            $select[] = ["id" => $item->id, "text" => $item->name];
        }

        return response()->json(["error" => false, "data" => $select]);
    }

    public function export_jadwal($awal, $akhir)
    {
        $jadwal = Jadwal::with('kegiatan', 'user')
            ->whereBetween('waktu_mulai', [$awal, $akhir])
            ->get();
        return view('dashboard.jadwal.export-jadwal', [
            'awal' => $awal,
            'akhir' => $akhir,
            'jadwal' => $jadwal
        ]);
    }
}
