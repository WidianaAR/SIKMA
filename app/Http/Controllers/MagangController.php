<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;

class MagangController extends Controller
{
    public function tampil(){ 
        $posts = Magang::all();      
        $ubah = NULL;
        return view('h_magang', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]); 
    }

    public function tambah(Request $request){
        $data = $request->validate([
            'nama_mahasiswa' => 'required|max:50',
            'NIM' => 'required',
            'instansi_magang' => 'required|max:30'
        ]);
        Magang::create($data);
        return redirect('/magang');
    }

    public function hapus($no_magang){
        $post = Magang::find($no_magang);
        $post->delete();
        return redirect('/magang');
    }

    public function ubah($no_magang){
        $ubah = Magang::findOrFail($no_magang);
        if(Auth::user()->level=='admin'||Auth::user()->level=='dosen') {
            $posts = Magang::all();
            return view('h_magang', [
                'ubah' => $ubah,
                'posts' => $posts,
            ]);
        } else {
            $email = Auth::user()->email;
            if($data = Mahasiswa::all()->where('email', $email)->first()) {
                $posts = Magang::all()->where('nama_mahasiswa', $data->nama_mahasiswa);
                return view('h_list_magang', [
                    'posts' => $posts,
                    'ubah' => $ubah,
                ]);
            };
        };
    }

    public function upload(Request $request, $no_magang){
        $file = $request->file;
        if($file==NULL) {
            $fileName = Magang::find($no_magang)->file;
        } elseif(Magang::find($no_magang)->file==NULL) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('file'), $fileName);
        } else {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('file'), $fileName);
            $fileOld = Magang::find($no_magang)->file;
            unlink(public_path('file/').$fileOld);
        };

        $post = Magang::find($no_magang)->update([
            'file' => $fileName,
        ]);
        return redirect('/magang/list');
    }

    public function update(Request $request, $no_magang){
        if($request->nama != NULL) {
            $post = Magang::find($no_magang)->update([
                'nama_mahasiswa' => $request->nama,
                'NIM' => $request->nim,
                'instansi_magang' => $request->instansi,
                'nilai_akhir' => $request->nilai
            ]); 
            return redirect('/magang');
        };
        if(Auth::user()->level=='dosen') {
            $post = Magang::find($no_magang);
            $post->nilai_akhir = $request->nilai;
            $post->status = 1;
            $post->keterangan = "Telah Dinilai";
            $post->update();
            return redirect('/magang');
        };
    }

    public function status($no_magang){
        if(Auth::user()->level=='admin') {
            $post = Magang::find($no_magang);
            $post->status = 1;
            $post->keterangan = "Disetujui";
            $post->update();
            return redirect('/notif');
        };
        if(Auth::user()->level=='mahasiswa') {
            $post = Magang::find($no_magang);
            $post->status = 2;
            $post->update();
            return redirect('/notif');
        };
    }

    public function daftar(){
        $ubah = NULL;
        $email = Auth::user()->email;
        if($data = Mahasiswa::all()->where('email', $email)->first()) {
            $posts = Magang::all()->where('nama_mahasiswa', $data->nama_mahasiswa);
            return view('h_list_magang', [
                'posts' => $posts,
                'ubah' => $ubah,
            ]);
        };
        $posts = NULL;
        return view('h_list_magang', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]);
    }

    public function form(){
        return view('h_form_magang');
    }

    public function unduh($file){
        return response()->download(public_path('file/'.$file));
    }

    public function unduhdatamagang()
    {
        $posts = [
            'magang' => Magang::all(),
        ];
        $html = view('h_unduhdatamagang', $posts);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
