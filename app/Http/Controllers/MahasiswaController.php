<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function tampil(){
        $posts = Mahasiswa::all();
        $ubah = NULL;
        return view('h_mahasiswa', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]); 
    }

    public function tambah(Request $request){
        $data = $request->validate([
            'nama_mahasiswa' => 'required|max:50',
            'email' => 'required|max:30',
            'NIM' => 'required',
            'prodi' => 'required|max:30',
            'jurusan' => 'required|max:50',
            'angkatan' => 'required',
            'telp' => 'required'
        ]);
        Mahasiswa::create($data);
        return back();
    }

    public function hapus($nama_mahasiswa){
        $post = Mahasiswa::find($nama_mahasiswa);
        $post->delete();
        return redirect('/mahasiswa');
    }

    public function ubah($nama_mahasiswa){
        $ubah = Mahasiswa::findOrFail($nama_mahasiswa);
        $posts = Mahasiswa::all();
        return view('h_mahasiswa', [
            'ubah' => $ubah,
            'posts' => $posts,
        ]);
    }

    public function update(Request $request, $nama_mahasiswa){
        $post = Mahasiswa::find($nama_mahasiswa)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'NIM' => $request->NIM,
            'prodi' => $request->prodi,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'telp' => $request->telp,
        ]); 
        return redirect('/mahasiswa');
    }
}
