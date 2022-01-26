<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KP;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\User;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;

class KPController extends Controller
{
    public function tampil(){ 
        $posts = KP::all();
        $dosen = Dosen::all();
        $ubah = NULL;
        $ubah_dospem = NULL;
        $ubah_semhas = NULL;
        return view('h_kp', [
            'ubah_semhas' => $ubah_semhas,
            'posts' => $posts,
            'ubah' => $ubah,
            'ubah_dospem' => $ubah_dospem,
            'dosen' => $dosen,
        ]); 
    }

    public function tambah(Request $request){
        $data = $request->validate([
            'nama_mahasiswa' => 'required|max:50',
            'NIM' => 'required',
            'judul_kp' => 'required|max:50',
            'instansi_kp' => 'required|max:30'
        ]);
        KP::create($data);
        return redirect('/kp');
    }

    public function hapus($no_kp){
        $post = KP::find($no_kp);
        $post->delete();
        return redirect('/kp');
    }

    // ubah terhubung dengan update
    public function ubah($no_kp){
        $ubah = KP::findOrFail($no_kp);
        if(Auth::user()->level=='admin'||Auth::user()->level=='dosen') {
            $posts = KP::all();
            $dosen = Dosen::all();
            $ubah_dospem = NULL;
            $ubah_semhas = NULL;
            return view('h_kp', [
                'ubah_semhas' => $ubah_semhas,
                'ubah' => $ubah,
                'posts' => $posts,
                'ubah_dospem' => $ubah_dospem,
                'dosen' => $dosen,
            ]);
        } else {
            $email = Auth::user()->email;
            if($data = Mahasiswa::all()->where('email', $email)->first()) {
                $posts = KP::all()->where('nama_mahasiswa', $data->nama_mahasiswa);
                return view('h_list_kp', [
                    'posts' => $posts,
                    'ubah' => $ubah,
                ]);
            };
        }
    }

    public function upload(Request $request, $no_kp){
        $file = $request->file;
        if($file==NULL) {
            $fileName = KP::find($no_kp)->file;
        } elseif(KP::find($no_kp)->file==NULL) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('file'), $fileName);
        } else {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('file'), $fileName);
            $fileOld = KP::find($no_kp)->file;
            unlink(public_path('file/').$fileOld);
        };

        $post = KP::find($no_kp)->update([
            'file' => $fileName,
        ]);
        return redirect('/kp/list');
    }

    public function update(Request $request, $no_kp){
        if($request->nama != NULL) {
            $post = KP::find($no_kp)->update([
                'nama_mahasiswa' => $request->nama,
                'NIM' => $request->nim,
                'judul_kp' => $request->judul,
                'instansi_kp' => $request->instansi,
                'nilai_akhir' => $request->nilai
            ]); 
            return redirect('/kp');
        };
        if(Auth::user()->level=='dosen') {
            $post = KP::find($no_kp);
            $post->nilai_akhir = $request->nilai;
            $post->status = 1;
            $post->keterangan = "Telah Dinilai";
            $post->update();
            return redirect('/kp');
        };
    }

    // saran terhubung dengan dospem
    public function saran($no_kp){
        $ubah_semhas = NULL;
        $ubah_dospem = KP::findOrFail($no_kp);
        $posts = KP::all();
        $dosen = Dosen::all();      
        $ubah = NULL;
        return view('h_kp', [
            'ubah_semhas' => $ubah_semhas,
            'ubah_dospem' => $ubah_dospem,
            'ubah' => $ubah,
            'posts' => $posts,
            'dosen' => $dosen,
        ]);
    }

    public function dospem(Request $request, $no_kp){
        $post = KP::find($no_kp);
        if($post->saran_dospem == NULL) {
            $post->saran_dospem = $request->saran_dospem;
            $post->status = 3;
            $post->update();
            return redirect('/kp');
        };
        // Dosen terima dilink ke sini
        if(Auth::user()->level=='dosen') {
            $post->nama_dosen = $post->saran_dospem;
            $post->status = 4;
            $post->keterangan = "Dospem Telah Ditentukan";
            $post->update();
            return redirect('/notif');
        };
    }

    // semhas terhubung dengan update_semhas
    public function semhas($no_kp){
        $ubah_semhas = KP::findOrFail($no_kp);
        $ubah_dospem = NULL;
        $posts = KP::all();
        $dosen = Dosen::all();      
        $ubah = NULL;
        return view('h_kp', [
            'ubah_semhas' => $ubah_semhas,
            'ubah_dospem' => $ubah_dospem,
            'ubah' => $ubah,
            'posts' => $posts,
            'dosen' => $dosen,
        ]);
    }

    public function update_semhas(Request $request, $no_kp){
        $post = KP::find($no_kp);
        $post->semhas = $request->semhas;
        $post->status = 1;
        $post->keterangan = "Jadwal Semhas Telah Ditentukan";
        $post->update();
        return redirect('/kp');
    }

    public function status($no_kp){
        if(Auth::user()->level=='admin') {
            $post = KP::find($no_kp);
            $post->status = 1;
            $post->keterangan = "Disetujui";
            $post->update();
            return redirect('/notif');
        };
        if(Auth::user()->level=='mahasiswa') {
            $post = KP::find($no_kp);
            $post->status = 2;
            $post->update();
            return redirect('/notif');
        };
        // Dosen menolak dilink ke sini
        if(Auth::user()->level=='dosen') {
            $post = KP::find($no_kp);
            $post->status = 5;
            $post->saran_dospem = NULL;
            $post->keterangan = "Dosen Menolak Menjadi Dospem";
            $post->update();
            return redirect('/notif');
        };
    }

    public function daftar(){
        $ubah = NULL;
        $email = Auth::user()->email;
        if($data = Mahasiswa::all()->where('email', $email)->first()) {
            $posts = KP::all()->where('nama_mahasiswa', $data->nama_mahasiswa);
            return view('h_list_kp', [
                'posts' => $posts,
                'ubah' => $ubah,
            ]);
        };
        $posts = NULL;
        return view('h_list_kp', [
            'posts' => $posts,
            'ubah' => $ubah,
        ]);
    }

    public function form(){
        return view('h_form_kp');
    }

    public function unduh($file){
        return response()->download(public_path('file/'.$file));
    }
    public function print()
    {
        $posts = KP::all();
        return view('h_print', [
            'posts' => $posts,
        ]);    

    }

    public function unduhdatakp()
    {
        $posts = [
            'kp' => KP::all(),
        ];
        $html = view('h_unduhdatakp', $posts);

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
