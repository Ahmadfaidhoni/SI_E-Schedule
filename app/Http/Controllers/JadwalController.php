<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Mail\NotifAccJadwal;
use App\Mail\NotifDinas;
use App\Mail\NotifEdit;
use App\Mail\NotifJadwal;
use App\Mail\NotifGantiPegawai;
use App\Mail\NotificationEmail;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Keuangan;
use App\Models\Ruangan;
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
                'jadwal' => Jadwal::where('request', false)->whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) >= curdate())")->orderBy('waktu_mulai', 'ASC')->get(),
                'users' => User::all(),
            ]);
        } else {
            return view('dashboard.jadwal.data-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::where('user_id', Auth::user()->id)->where('request', false)->whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) >= curdate())")->orderBy('waktu_mulai', 'ASC')->get(),
                'users' => User::all(),
                'keuangan' => Keuangan::where('jadwal_id', Auth::user()->id)->first(),
            ]);
        }
    }

    public function history()
    {
        $active_menu = 'jadwal';
        if (auth()->user()->level === "Admin") {
            return view('dashboard.jadwal.history-jadwal', compact('active_menu'), [
                'jadwal' => Jadwal::whereRaw("((STR_TO_DATE(waktu_mulai, '%Y-%m-%d') ) < curdate())")->orderBy('waktu_mulai', 'DESC')->get()
            ]);
        } else {
            return view('dashboard.jadwal.history-jadwal', compact('active_menu'), [
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
        $checkTipeJadwal = $request->tipe_jadwal;
        $config_max_jp = Config::where('key', 'MAX_JP')->first();

        $biaya = null;
        $biaya_harian = null;
        $biaya_penginapan = null;
        $biaya_representasi = null;
        $biaya_transport = null;
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

            $biaya = $request->biaya ?? 0;
            $biaya_harian = $request->biaya_harian ?? 0;
            $biaya_penginapan = $request->biaya_penginapan ?? 0;
            $biaya_transport = $request->biaya_transport ?? 0;
            $biaya_representasi = $request->biaya_representasi ?? 0;


            $validatedData['user_id'] = $validatedData['user_id'];
        } else {
            $validatedData = $request->validate([
                'tipe_jadwal' => 'required',
                'kegiatan_id' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'tanggal_akhir' => '',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
                'jp' => 'required',
                'angkatan' => 'required',
                'keterangan' => '',
                'ruangan_id' => ''
            ]);

            $config_biaya = Config::where('key', 'BIAYA_JP')->first();
            $biaya = ($config_biaya->value ?? 45000) * $validatedData['jp'];

            $validatedData['user_id'] = $validatedData['user_id'];

            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " " . $validatedData['waktu_mulai'];
            $validatedData['waktu_selesai'] = $validatedData['tanggal']  . " " . $validatedData['waktu_selesai'];
        }

        $validatedData['created_by'] = Auth::user()->name;

        $jadwal = Jadwal::create($validatedData);

        Keuangan::create([
            'jadwal_id' => $jadwal->id,
            'biaya' => $biaya,
            'biaya_harian' => $biaya_harian ?? 0,
            'biaya_penginapan' => $biaya_penginapan ?? 0,
            'biaya_transport' => $biaya_transport ?? 0,
            'biaya_representasi' => $biaya_representasi ?? 0
        ]);

        // get validate
        $getIdUser = $validatedData['user_id'];
        $getEmail = User::find($getIdUser)->email;

        if ($checkTipeJadwal == 1) {
            $validatedData['ruangan'] = Ruangan::find($validatedData['ruangan_id'])->nama_ruangan ?? '-';
            $validatedData['kegiatan'] = Kegiatan::find($validatedData['kegiatan_id'])->nama_kegiatan ?? '-';
        }

        $validatedData['biaya'] = $biaya;

        //kirim email
        if ($getEmail != null) {
            Mail::to($getEmail)->send(new NotifJadwal($validatedData));
        }

        Alert::success('Congrats', 'Jadwal Berhasil ditambah!');
        return redirect('/jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {

        $active_menu = 'jadwal';
        return view('dashboard.jadwal.show-jadwal', compact('active_menu'), [
            'jdwl' => $jadwal,
            'biaya' => Keuangan::where('jadwal_id', $jadwal->id)->first()
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
        $active_menu = 'jadwal';
        return view('dashboard.jadwal.edit-jadwal', compact('active_menu'), [
            "kegiatan" => Kegiatan::all(),
            "pegawai" => User::all(),
            "jadwal" => $jadwal,
            "biaya" => Keuangan::where('jadwal_id', $jadwal->id)->first(),
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

        // Cek request an atau bukan
        $checkRequest = $jadwal->request;
        $userIdBefore = $jadwal->user_id;
        $getEmailBefore = User::find($userIdBefore)->email;

        $config_max_jp = Config::where('key', 'MAX_JP')->first();

        if ($checkTipeJadwal != 1) {

            $tanggal_akhir = $request->tanggal_akhir;
            $validatedData = $request->validate([
                'user_id' => 'required',
                'tanggal' => 'required',
                'keterangan' => '',
            ]);

            $validatedData['tipe_jadwal'] = $checkTipeJadwal;
            $validatedData['kegiatan_id'] = null;
            $validatedData['angkatan'] = null;
            $validatedData['jp'] = $config_max_jp->value ?? 15;
            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " 00:00:00";
            $validatedData['waktu_selesai'] = $tanggal_akhir . " 23:59:00";

            $biaya = $request->biaya;

            Keuangan::where('jadwal_id', $jadwal->id)->update([
                'biaya' => $biaya
            ]);
        } else {
            $validatedData = $request->validate([
                'kegiatan_id' => 'required',
                'user_id' => 'required',
                'tanggal' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
                'jp' => 'required',
                'angkatan' => 'required',
                'keterangan' => '',
                'ruangan_id' => ''
            ]);

            $validatedData['tipe_jadwal'] = $checkTipeJadwal;
            $validatedData['waktu_mulai'] = $validatedData['tanggal'] . " " . $validatedData['waktu_mulai'];
            $validatedData['waktu_selesai'] = $validatedData['tanggal'] . " " . $validatedData['waktu_selesai'];

            $config_biaya = Config::where('key', 'BIAYA_JP')->first();

            $biaya = ($config_biaya->value ?? 45000) * $validatedData['jp'];

            Keuangan::where('jadwal_id', $jadwal->id)->update([
                'biaya' => $biaya
            ]);
        }

        unset($validatedData['tanggal']);

        $validatedData['user_id'] = $validatedData['user_id'];

        $validatedData['request'] = false;
        $validatedData['alasan'] = null;

        $validatedData['edited_by'] = Auth::user()->name;

        Jadwal::where('id', $jadwal->id)->update($validatedData);

        // get validate
        $getIdUser = $validatedData['user_id'];
        $getEmail = User::find($getIdUser)->email;

        // send validate
        if ($checkTipeJadwal == 1) {
            $validatedData['ruangan'] = Ruangan::find($validatedData['ruangan_id'])->nama_ruangan ?? '-';
            $validatedData['kegiatan'] = Kegiatan::find($validatedData['kegiatan_id'])->nama_kegiatan ?? '-';
        }

        $validatedData['biaya'] = $biaya;

        // kirim email
        if ($checkRequest == true) {
            if ($userIdBefore == $getIdUser) {
                if ($getEmailBefore != null) {
                    Mail::to($getEmailBefore)->send(new NotifAccJadwal($validatedData));
                }
            } else {
                if ($getEmail != null) {
                    Mail::to($getEmail)->send(new NotifJadwal($validatedData));
                }

                if ($getEmailBefore != null) {
                    Mail::to($getEmailBefore)->send(new NotifGantiPegawai($validatedData));
                }
            }
        } else {
            if ($userIdBefore == $getIdUser) {
                if ($getEmailBefore != null) {
                    Mail::to($getEmail)->send(new NotifEdit($validatedData));
                }
            } else {
                if ($getEmail != null) {
                    Mail::to($getEmail)->send(new NotifJadwal($validatedData));
                }
            }
        }

        Alert::success('Congrats', 'Jadwal Berhasil diubah!');
        return redirect('/jadwal');
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
        return redirect('/jadwal');
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
        $jp = $request->jp;

        // Cari user dan ruangan yang bentrok
        $bentrok = DB::table('jadwals')
            ->select('user_id', 'ruangan_id')
            ->whereRaw("
                (
                    (waktu_mulai < '$tanggal_mulai' AND waktu_selesai > '$tanggal_mulai') OR
                    (waktu_mulai < '$tanggal_selesai' AND waktu_selesai > '$tanggal_selesai') OR 
                    (waktu_mulai >= '$tanggal_mulai' AND waktu_selesai <= '$tanggal_selesai')
                )
            ")
            ->get()
            ->toArray();

        $idBentrok = [];
        $idRuangan = [];

        foreach ($bentrok as $items) {
            if ($items->ruangan_id == !null) {
                $idRuangan[] = $items->ruangan_id;
            }
            $idBentrok[] = $items->user_id;
        }

        $max_jp = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("waktu_mulai >= STR_TO_DATE('$request->tanggal 00:00:00', '%Y-%m-%d %H:%i:%s') AND waktu_selesai <= STR_TO_DATE('$request->tanggal 23:59:59', '%Y-%m-%d %H:%i:%s')")
            ->groupBy('user_id')
            ->having(DB::raw("(SUM(jp)+$jp)"), '>', $limit_max_jp)
            ->get()->toArray();

        foreach ($max_jp as $item) {
            $idBentrok[] = $item->user_id;
        }

        $users = DB::table('users')
            ->where('id', '!=', '1')
            ->whereNotIn('id', $idBentrok)
            ->orderBy('name', 'ASC')
            ->get()
            ->toArray();

        $ruangans = DB::table('ruangans')
            ->whereNotIn('id', $idRuangan)
            ->orderBy('nama_ruangan', 'ASC')
            ->get()
            ->toArray();

        $selectPegawai = [];
        foreach ($users as $item) {
            $selectPegawai[] = ["id" => $item->id, "text" => $item->name];
        }

        $selectRuangan = [];
        foreach ($ruangans as $item) {
            $selectRuangan[] = ["id" => $item->id, "text" => $item->nama_ruangan];
        }

        return response()->json(["error" => false, "data" => [
            "users" => $selectPegawai,
            "ruangans" => $selectRuangan
        ]]);

        return response()->json(["error" => false, "data" => $select]);

        // echo json_encode([
        //      'data' => $checking,
        //      'debug' => [
        //          'tanggal_mulai' => $tanggal_mulai,
        //          'tanggal_selesai' => $tanggal_selesai,
        //          'arr_user_id' => $arr_user_id,
        //      ]
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

        $bentrok = DB::table('jadwals')
            ->select('user_id', 'ruangan_id')
            ->whereRaw("
                (
                    (waktu_mulai < '$tanggal_selesai' AND waktu_selesai > '$tanggal_mulai')
                    OR (waktu_mulai < '$tanggal_selesai' AND waktu_selesai > '$tanggal_selesai')
                    OR (waktu_mulai >= '$tanggal_mulai' AND waktu_selesai <= '$tanggal_selesai')
                )
                AND id != '$id'
            ")
            ->get()
            ->toArray();

        $idBentrok = [];
        $idRuangan = [];

        foreach ($bentrok as $items) {
            if ($items->ruangan_id == !null) {
                $idRuangan[] = $items->ruangan_id;
            }
            $idBentrok[] = $items->user_id;
        }

        $max_jp = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("(waktu_mulai >= STR_TO_DATE('$request->tanggal 00:00:00', '%Y-%m-%d %H:%i:%s') AND waktu_selesai <= STR_TO_DATE('$request->tanggal 23:59:59', '%Y-%m-%d %H:%i:%s')) 
            AND id != '$id'")
            ->groupBy('user_id')
            ->having(DB::raw("(SUM(jp)+$jp)"), '>', $limit_max_jp)
            ->get()->toArray();

        foreach ($max_jp as $item) {
            $idBentrok[] = $item->user_id;
        }

        $users = DB::table('users')
            ->where('id', '!=', '1')
            ->whereNotIn('id', $idBentrok)
            ->orderBy('name', 'ASC')
            ->get()
            ->toArray();

        $ruangans = DB::table('ruangans')
            ->where('id', '!=', '1')
            ->whereNotIn('id', $idRuangan)
            ->orderBy('nama_ruangan', 'ASC')
            ->get()
            ->toArray();

        $selectPegawai = [];
        foreach ($users as $item) {
            $selectPegawai[] = ["id" => $item->id, "text" => $item->name];
        }

        $selectRuangan = [];
        foreach ($ruangans as $item) {
            $selectRuangan[] = ["id" => $item->id, "text" => $item->nama_ruangan];
        }

        return response()->json(["error" => false, "data" => [
            "users" => $selectPegawai,
            "ruangans" => $selectRuangan
        ]]);
    }

    public function checkJadwalDinas(Request $request)
    {
        $jp = Config::where('key', 'MAX_JP')->first();
        $tanggal_mulai = $request->tanggal . ' ' . $request->mulai;
        $tanggal_selesai = $request->tanggal_akhir . ' ' . $request->selesai;

        // Cari user
        $bentrok = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("
                (waktu_mulai >= '$tanggal_mulai' AND waktu_mulai <= '$tanggal_selesai')
                OR (waktu_selesai >= '$tanggal_mulai' AND waktu_selesai <= '$tanggal_selesai')
                OR ('$tanggal_mulai' >= waktu_mulai AND '$tanggal_mulai' <= waktu_selesai)
                OR ('$tanggal_selesai' >= waktu_mulai AND '$tanggal_selesai' <= waktu_selesai)
            ")
            ->get()
            ->toArray();

        $idBentrok = [];

        foreach ($bentrok as $items) {
            $idBentrok[] = $items->user_id;
        }

        $users = DB::table('users')
            ->where('id', '!=', '1')
            ->whereNotIn('id', $idBentrok)
            ->orderBy('name', 'ASC')
            ->get()
            ->toArray();

        $selectPegawai = [];
        foreach ($users as $item) {
            $selectPegawai[] = ["id" => $item->id, "text" => $item->name];
        }

        return response()->json(["error" => false, "data" => $selectPegawai]);
    }

    public function checkJadwalDinasUpdate(Request $request)
    {
        $jp = Config::where('key', 'MAX_JP')->first();
        $tanggal_mulai = $request->tanggal . ' ' . $request->mulai;
        $tanggal_selesai = $request->tanggal_akhir . ' ' . $request->selesai;
        $id = $request->id;

        // Cari user
        $bentrok = DB::table('jadwals')
            ->select('user_id')
            ->whereRaw("(
                (waktu_mulai >= '$tanggal_mulai' AND waktu_mulai <= '$tanggal_selesai')
                OR (waktu_selesai >= '$tanggal_mulai' AND waktu_selesai <= '$tanggal_selesai')
                OR ('$tanggal_mulai' >= waktu_mulai AND '$tanggal_mulai' <= waktu_selesai)
                OR ('$tanggal_selesai' >= waktu_mulai AND '$tanggal_selesai' <= waktu_selesai)) AND id != '$id'
            ")
            ->get()
            ->toArray();

        $idBentrok = [];

        foreach ($bentrok as $items) {
            $idBentrok[] = $items->user_id;
        }

        $users = DB::table('users')
            ->where('id', '!=', '1')
            ->whereNotIn('id', $idBentrok)
            ->orderBy('name', 'ASC')
            ->get()
            ->toArray();

        $selectPegawai = [];
        foreach ($users as $item) {
            $selectPegawai[] = ["id" => $item->id, "text" => $item->name];
        }

        return response()->json(["error" => false, "data" => $selectPegawai]);
    }

    public function export_jadwal($awal, $akhir, $user, $tipe_jadwal)
    {
        $config_max_jp = Config::where('key', 'MAX_JP')->first();
        $max_jp = $config_max_jp->value ?? 15;

        $jadwal = Jadwal::with('kegiatan', 'user', 'ruangan')
            ->where(function ($query) use ($awal, $akhir) {
                $query->whereDate('jadwals.waktu_mulai', '=', $awal)
                    ->orWhereDate('jadwals.waktu_mulai', '=', $akhir)
                    ->orWhereBetween('jadwals.waktu_mulai', [$awal, $akhir])
                    ->orWhereRaw("
                    (waktu_mulai >= '$awal' AND waktu_mulai <= '$akhir')
                    OR (waktu_selesai >= '$awal' AND waktu_selesai <= '$akhir')
                    OR ('$awal' >= waktu_mulai AND '$awal' <= waktu_selesai)
                    OR ('$akhir' >= waktu_mulai AND '$akhir' <= waktu_selesai)
                ");
            });

        if ($user != 'all') {
            $jadwal->where('user_id', $user);
        }

        if ($tipe_jadwal != 'all') {
            $jadwal->where('tipe_jadwal', $tipe_jadwal);
        }

        $jadwal = $jadwal->orderBy('waktu_mulai', 'ASC')->get();

        if ($tipe_jadwal == '1') {
            $tipe_jadwal = 'Mengajar';
        } else if ($tipe_jadwal == '2') {
            $tipe_jadwal = 'Perjalan Dinas';
        } else {
            $tipe_jadwal = 'Seluruh Kegiatan';
        }

        if ($user != 'all') {
            $user = User::find($user)->name;
        } else {
            $user = 'Seluruh Pegawai';
        }

        return view('dashboard.jadwal.export-jadwal', [
            'awal' => $awal,
            'akhir' => $akhir,
            'jadwal' => $jadwal,
            'tipe_jadwal' => $tipe_jadwal,
            'user' => $user,
            'max_jp' => $max_jp
        ]);
    }
}
