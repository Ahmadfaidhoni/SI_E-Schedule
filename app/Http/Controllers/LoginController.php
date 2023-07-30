<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function authenticate(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request['login'])->
                        orWhere('nip', $request['login'])->first();

        $password = $request->input('password');

        if($user){
            if(Hash::check($password, $user->password)){
                if(!is_numeric($request['login'])){
                    $email = $request->input('login');

                    if (Auth::attempt(['email' => $email, 'password' => $password])) {
                        return redirect()->intended('/');
                    }
                } else {
                    $nip = $request->input('login');

                    if (Auth::attempt(['nip' => $nip, 'password' => $password])) {
                        return redirect()->intended('/');
                    }
                }
            }
        }
        
        Alert::error('Uppss!', 'Username atau Password Salah');
        
        return back();
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
