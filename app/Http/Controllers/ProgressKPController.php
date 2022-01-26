<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\progressKP;
use Illuminate\Support\Facades\Auth;

class ProgressKPController extends Controller
{
    public function tampil($no_kp){
        $posts = progressKP::all()->where('no_kp', $no_kp);
        $no_kp = $no_kp;
        $ubah = NULL;
        return view('h_progress_kp', [
            'posts' => $posts,
            'no_kp' => $no_kp,
            'ubah' => $ubah,
        ]); 
    }

    public function tambah(Request $request, $no_kp){
        $request->validate([
            'no_kp' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required|max:500',
            'file' => 'required|unique:progress_kp,file|mimes:jpg,jpeg,bmp,png,pdf,zip|max:2048',
        ]);

        //jika validasi tidak ada maka lakukan simpan data
        $file = $request->file;
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('file'), $fileName);

        $data = [
            'no_kp' => $request->no_kp,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'file' => $fileName,
        ];

        progressKP::create($data);
        return redirect()->route('halaman_progress_kp', $no_kp);
    }

    public function hapus($no_progress, $no_kp){
        $post = progressKP::find($no_progress);
        $post->delete();
        $file = $post->file;
        unlink(public_path('file/'). $file);
        return redirect()->route('halaman_progress_kp', $no_kp);
    }

    // ubah terhubung dengan update
    public function ubah($no_progress, $no_kp){
        $ubah = progressKP::findOrFail($no_progress);
        $posts = progressKP::all()->where('no_kp', $no_kp);
        $no_kp = $no_kp;
        return view('h_progress_kp', [
            'posts' => $posts,
            'no_kp' => $no_kp,
            'ubah' => $ubah,
        ]); 
    }

    public function update(Request $request, $no_progress, $no_kp){
        if(Auth::user()->level=='mahasiswa') {
            $file = $request->file;
            if($file==NULL) {
                $fileName = progressKP::find($no_progress)->file;
            } else {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('file'), $fileName);
                $fileOld = progressKP::find($no_progress)->file;
                unlink(public_path('file/').$fileOld);
            }
            $post = progressKP::find($no_progress)->update([
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'file' => $fileName,
            ]); 
            return redirect()->route('halaman_progress_kp', $no_kp);
        };
        if(Auth::user()->level=='dosen') {
            $post = progressKP::find($no_progress);
            $post->komentar = $request->komentar;
            $post->nilai = $request->nilai;
            $post->update();
            return redirect()->route('halaman_progress_kp', $no_kp);
        };
    }

    public function unduh($file){
        return response()->download(public_path('file/'.$file));
    }
}
