<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function tampil(){
        $posts = Dosen::all();
        $ubah = NULL;
        return view('h_dosen', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]); 
    }

    public function tambah(Request $request){
        $data = $request->validate([
            'nama_dosen' => 'required|max:50',
            'email' => 'required|max:30',
            'NIP' => 'required',
            'jurusan' => 'required|max:50',
            'telp' => 'required'
        ]);
        Dosen::create($data);
        return back();
    }

    public function hapus($nama_dosen){
        $post = Dosen::find($nama_dosen);
        $post->delete();
        return redirect('/dosen');
    }

    public function ubah($nama_dosen){
        $ubah = Dosen::findOrFail($nama_dosen);
        $posts = Dosen::all();
        return view('h_dosen', [
            'ubah' => $ubah,
            'posts' => $posts,
        ]);
    }

    public function update(Request $request, $nama_dosen){
        $post = Dosen::find($nama_dosen)->update([
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
            'NIP' => $request->NIP,
            'jurusan' => $request->jurusan,
            'telp' => $request->telp,
        ]); 
        return redirect('/dosen');
    }
}
