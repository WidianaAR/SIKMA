<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function halamanlogin(){
        return view('h_login');
    }

    public function halamangp(){
        return view('h_gantipass');
    }

    public function ganti_pass(Request $request){
        $email = $request->email;
        $old_pass = $request->old_password;
        // Alasan tidak menggunakan Model::Find adalah karena Find mencari berdasarkan primary key, sedangkan email bukan
        $post = User::where('email', '=', $email)->first();
        if(Hash::check($old_pass, $post->password)) {
            $post->update(['password' => Hash::make($request->new_password)]);
            return redirect('/login')->with('success', 'Password berhasil diganti');
        };
        return back()->with('error', 'Pastikan password lama benar');;
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required', //email:dns -> digunakan untuk mengecek apakah email valid atau tidak (memakan waktu)
            'password' => 'required'
        ]);
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->with('loginError', 'Login Fail');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
