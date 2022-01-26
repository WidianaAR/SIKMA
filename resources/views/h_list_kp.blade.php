@extends('layouts.navbar')

<!-- <style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style> -->

@section('isi')
<body style="background-color: #D8E3E7;">
    <a href="{{ route('halaman_kp') }}"><button class="btn btn-warning mx-3">Kembali</button></a>
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow-sm" style="height: 400px;">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center text-light" colspan="15" style="background-color: #008891;">Data KP</th>
                </tr>
            </thead>
            <tbody>
                @if ($posts == Null)
                <tr class="text-light text-center" style="background-color: #008891;"><td>Data Kosong</td></tr>
                @endif
                @if ($posts != Null)
                <tr class="text-light text-center" style="background-color: #008891;">
                    <td><b>Nama Mahasiswa</b></td>
                    <td><b>Dosen Pembimbing</b></td>
                    <td><b>NIM</b></td>
                    <td><b>Judul KP</b></td>
                    <td><b>Instansi</b></td>
                    <td><b>Jadwal Semhas</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Nilai Akhir</b></td>
                    <td><b>Laporan Akhir</b></td>
                    <td colspan="3"><b>Fungsi</b></td>
                </tr>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->nama_dosen}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->judul_kp}}</td>
                    <td>{{$post->instansi_kp}}</td>
                    <td>{{$post->semhas}}</td>
                    <td>{{$post->keterangan}}</td>
                    <td>{{$post->nilai_akhir}}</td>
                    <td>{{$post->file}}</td>
                    <form method="GET" action="{{ url('/progress_kp', $post->no_kp) }}">
                        @csrf
                    <td><button class="btn btn-primary col-12" type="submit">Progress</button></td>
                    </form>
                    <form method="GET" action="{{ url('kp/edit', $post->no_kp) }}">
                        @csrf
                    <td><button class="btn btn-primary col-12" type="submit">Upload</button></td>
                    </form>
                    <form method="POST" action="{{ url('kp/laporan_unduh', $post->file) }}">
                        @csrf
                    <td><button class="btn btn-primary col-12" type="submit">Download</button></td>
                    </form>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @if ($ubah != Null)
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 160px;">
        <div class="badge fs-3 text-dark">Upload Laporan Akhir</div>
        <form method="POST" action="{{ url('kp/laporan', $ubah->no_kp ) }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name='file' class="form-control rounded-top @error('file') is-invalid @enderror" title="NIM_Judul KP">
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ url('kp/list') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    @endif

</body>
@endsection