<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\KP;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $jumlah = 0;

    public function mount()
    {
        if(Auth::user()->level=='admin') {
            $data1 = Magang::where('status', 0)->count();
            $data2 = KP::where('status', 0)->count();
            $data3 = KP::where('status', 4)->count();
            $data4 = KP::where('status', 5)->count();
            $this->jumlah = $data1+$data2+$data3+$data4;
        };
        if(Auth::user()->level=='mahasiswa') {
            $email = Auth::user()->email;
            $data1 = Mahasiswa::all()->where('email', $email)->first();
            $data2 = Magang::where('status', 1)->where('nama_mahasiswa', $data1->nama_mahasiswa)->count();
            $data3 = KP::where('status', 1)->where('nama_mahasiswa', $data1->nama_mahasiswa)->count();
            $data4 = KP::where('status', 4)->where('nama_mahasiswa', $data1->nama_mahasiswa)->count();
            $this->jumlah = $data2+$data3+$data4;
        };
        if(Auth::user()->level=='dosen') {
            $email = Auth::user()->email;
            $data1 = Dosen::all()->where('email', $email)->first();
            $data2 = KP::where('status', 3)->where('saran_dospem', $data1->nama_dosen);
            $this->jumlah = $data2->count();
        };
    }

    public function render()
    {
        return view('livewire.navbar',[
            'jum_notif' => $this->jumlah,
        ]);

    }
}
