<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function tampil(){
        $posts = User::all();
        $ubah = NULL;
        return view('h_user', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]); 
    }

    public function tambah(Request $request){
        $data = $request->validate([
            'email' => 'required|max:30|unique:users',
            'password' => 'required|min:5',
            'nama' => 'required|max:50',
            'level' => 'required'
        ]);
        //password wajib di-Hash atau enkripsi agar bisa di autentikasi
        // $validatedData['password'] = bcrypt($validatedData['password']); //fungsi enkripsi tanpa hash
        $data['password'] = Hash::make($data['password']); //enkripsi dengan hash
        $data['level'] = Str::lower($data['level']);
        User::create($data);
        return back();
    }

    public function hapus($id){
        $post = User::find($id);
        $post->delete();
        return redirect('/user');
    }

    public function ubah($id){
        $ubah = User::findOrFail($id);
        $posts = User::all();
        return view('h_user', [
            'ubah' => $ubah,
            'posts' => $posts,
        ]);
    }

    public function update(Request $request, $id){
        $post = User::find($id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'level' => Str::lower($request->level)
        ]); 
        return redirect('/user');
    }
}
