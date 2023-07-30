<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Golongan;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'profiles' => User::where('id', Auth::user()->id)->get()
        ]);
    }

    public function edit()
    {
        $auth = Auth::user();
        $user = User::find($auth->id);
        return view('profile.edit-profile', [
            "user" => $user,
            // "golongan" => Golongan::orderBy('jenis_golongan', 'ASC')->orderBy('ruang', 'ASC')->get()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'jabatan' => '',
            'golongan_id' => '',
            'status_anggota' => ''
        ];

        if ($request->nip != $user->nip) {
            $rules['nip'] = 'required|unique:users';
        }

        if (($request->email != null) && ($request->email != $user->email)) {
            $rules['email'] = 'unique:users';
        }

        if (($request->phone != null) && ($request->phone != $user->phone)) {
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

        User::where('id', $user->id)->update($validatedData);

        Alert::success('Congrats', 'Data Profile Berhasil diubah!');
        return redirect('/profile');
        // return redirect('/profile')->with('success', 'Data Profile Berhasil diubah.');
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        Alert::success('Congrats', 'Password Berhasil diubah!');
        return redirect('/profile');
        // return redirect('/profile')->with('successPassword', 'Password Berhasil diubah.');
    }

    public function reset($id)
    {
        $password = "password";

        $user = User::find($id);
        $user->update(['password' => Hash::make($password)]);

        // Alert::success('Congrats', 'Password Berhasil direset!');
        // return redirect('/data-pegawai-' . $user->nip);

        return  response()->json(['error' => false]);
    }
}
