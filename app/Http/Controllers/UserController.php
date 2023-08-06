<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Mail\NotifUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'data-pegawai';
        return view('dashboard.pegawai.data-pegawai', compact('active_menu'), [
            "pegawai" => User::where('id', '!=', '1')->orderBy('name', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'data-pegawai';
        return view('dashboard.pegawai.add-pegawai', compact('active_menu'), [
            "pegawai" => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $rules = [
            'nip' => 'required',
            'name' => 'required',
            'jabatan' => 'required',
            'level' => 'required',
        ];

        if ($request->nip != $user->nip) {
            $rules['nip'] = 'unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'unique:users';
        }

        if ($request->phone != $user->phone) {
            $rules['phone'] = 'unique:users';
        }

        $validatedData = $request->validate($rules);

        $validatedData['password'] = $validatedData['nip'];

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->File('imgFile') != null) {
            $file = $request->file('imgFile');
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/user/'), $filename);
            $validatedData['picture'] = 'images/user/' . $filename;
        }

        User::create($validatedData);

        $email = $request->email;

        // if ($request->email != null) {
        //     Mail::to($email)->send(new NotifUser($validatedData));
        // }

        Alert::success('Congrats', 'Data Pegawai Berhasil dibuat.');
        return redirect('/data-pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Jadwal $jadwal)
    {
        $active_menu = 'data-pegawai';
        return view('dashboard.pegawai.show-pegawai', compact('active_menu'), [
            "user" => $user,
            'jadwal' => $jadwal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        $active_menu = 'data-pegawai';
        return view('dashboard.pegawai.edit-pegawai', compact('active_menu'), [
            "pegawai" => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {

        $rules = [
            'nip' => 'required',
            'name' => 'required',
            'jabatan' => 'required',
            'level' => 'required',
            'status_anggota' => 'required'
        ];

        if ($request->nip != $pegawai->nip) {
            $rules['nip'] = 'required|unique:users';
        }

        if (($request->email != null) && ($request->email != $pegawai->email)) {
            $rules['email'] = 'unique:users';
        }

        if (($request->phone != null) && ($request->phone != $pegawai->phone)) {
            $rules['phone'] = 'unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->email == null) {
            $validatedData['email'] = null;
        }

        if ($request->phone == null) {
            $validatedData['phone'] = null;
        }

        if ($request->File('imgFile') != null) {
            $file = $request->file('imgFile');
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/user/'), $filename);
            $validatedData['picture'] = 'images/user/' . $filename;
        }

        User::where('id', $pegawai->id)->update($validatedData);

        Alert::success('Congrats', 'Data Pegawai Berhasil diubah!');
        return redirect('/data-pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        $pegawaiId = $pegawai->id;
        $jadwalId = Jadwal::where('user_id', $pegawaiId);
        $jadwalId->delete();

        User::destroy($pegawai->id);

        Alert::success('Congrats', 'Data Pegawai Berhasil dihapus.');

        return redirect('/data-pegawai');
        // return redirect('/data-pegawai')->with('success', 'Data Pegawai Berhasil dihapus.');
    }
}
