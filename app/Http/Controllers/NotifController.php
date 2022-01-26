<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\KP;
use Illuminate\Support\Facades\Auth;

class NotifController extends Controller
{
    public function tampil(){ 
        if(Auth::user()->level=='admin') {
            $posts_magang = Magang::all()->where('status', 0);      
            $posts_kp = KP::select("*")->where('status', 0)->orWhere('status', 4)->orWhere('status', 5)->get();
            return view('h_notif', [
                'posts_magang' => $posts_magang,
                'posts_kp' => $posts_kp,
            ]);
        };
        if(Auth::user()->level=='mahasiswa') {
            $email = Auth::user()->email;
            if($data = Mahasiswa::all()->where('email', $email)->first()) {
                $posts_magang = Magang::all()->where('nama_mahasiswa', $data->nama_mahasiswa)->where('status', 1);
                $posts_kp = KP::select("*")->where('nama_mahasiswa', $data->nama_mahasiswa)->where(function($q){
                    $q->where('status', 1)->orWhere('status', 4);
                })->get();
                return view('h_notif', [
                    'posts_magang' => $posts_magang,
                    'posts_kp' => $posts_kp,
                ]);
            };
        };
        if(Auth::user()->level=='dosen') {
            $email = Auth::user()->email;
            if($data = Dosen::all()->where('email', $email)->first()) {
                $posts_kp = KP::all()->where('saran_dospem', $data->nama_dosen)->where('status', 3);
                return view('h_notif', [
                    'posts_kp' => $posts_kp,
                ]);
            };
        };
    }
}
