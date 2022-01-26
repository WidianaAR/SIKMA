@extends('layouts.navbar')
<!-- 
<style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style> -->

@section('isi')
<body>
    <div class="row text-center align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="10" style="background-color: #D8E3E7;">Progress KP</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Tanggal</b></td>
                <td><b>Keterangan</b></td>
                <td><b>Komentar</b></td>
                <td><b>Nilai</b></td>
                <td><b>File</b></td>
                <td colspan="5"><b>Edit</b></td>
            </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{$post->tanggal}}</td>
                <td>{{$post->keterangan}}</td>
                <td>{{$post->komentar}}</td>
                <td>{{$post->nilai}}</td>
                <td>{{$post->file}}</td>
                <form method="POST" action="{{ url('progress_kp/unduh', $post->file ) }}">
                    @csrf
                <td><button class="btn btn-primary mx-1 col-12" type="submit">Download</button></td>
                </form>

                @if (auth()->user()->level=='mahasiswa')
                    <form method="GET" action="{{ route('ubah_progress_kp',['no_progress'=>$post->no_progress, 'no_kp'=>$post->no_kp]) }}">
                        @csrf
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Edit</button></td>
                    </form>
                    
                    <form method="POST" action="{{ route('hapus_progress_kp', ['no_progress'=>$post->no_progress, 'no_kp'=>$post->no_kp]) }}">
                        @csrf
                        @method('DELETE')
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Hapus</button></td>
                    </form>
                @endif

                @if (auth()->user()->level=='dosen')
                    <form method="GET" action="{{ route('ubah_progress_kp',['no_progress'=>$post->no_progress, 'no_kp'=>$post->no_kp]) }}">
                        @csrf
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Komentar / Nilai</button></td>
                    </form>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <br><br>

    @if ($ubah != Null && auth()->user()->level=='mahasiswa')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 240px;">
        <div class="badge fs-2 text-dark">Ubah Data</div>
        <form method="POST" action="{{ route('update_progress_kp',['no_progress'=>$ubah->no_progress, 'no_kp'=>$ubah->no_kp]) }}" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Tanggal</span>
                <input class="form-control col-9" name="tanggal" value="{{ $ubah->tanggal }}" type="text" placeholder="yyyy-mm-dd">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Keterangan</span>
                <input class="form-control col-9" name="keterangan" value="{{ $ubah->keterangan }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">File</span>
                <input class="form-control col-9" name="file" value="{{ $ubah->file }}" type="file">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_progress_kp', $no_kp) }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
        <br><br>
    @endif

    @if ($ubah != Null && auth()->user()->level=='dosen')
    <div class="container mb-5 text-center shadow rounded" style="width: 430px; height: 240px; background-color: #D8E3E7; ">
        <div class="badge fs-2 text-dark">Komentar/Nilai</div>
        <form method="POST" action="{{ route('update_progress_kp',['no_progress'=>$ubah->no_progress, 'no_kp'=>$ubah->no_kp]) }}">
            @csrf

            <textarea class="form-control mb-2" name="komentar" value="{{ $ubah->komentar }}" placeholder="Masukkan Komentar" type="text"></textarea>
            <input class="form-control mb-2" name="nilai" value="{{ $ubah->nilai }}" type="text" placeholder="Nilai">
            <button class="btn btn-primary mx-1"><a href="{{ route('halaman_progress_kp', $no_kp) }}" style="color: white; text-decoration: NONE">Cancel</a></button>
            <button class="btn btn-primary mx-1" type="submit">Simpan</button>
        </form>
    @endif

    @if (auth()->user()->level=='mahasiswa')
    <div class="container mb-5 text-center rounded-3 shadow" style="width: 430px; height: 280px; background-color: #D8E3E7;">
        <div class="badge fs-2 text-dark">Tambah Data</div>
        <form method="POST" action="{{ url('progress_kp', $no_kp ) }}" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Nomor KP</span>
                <input type="text" name='no_kp' class="form-control rounded-top @error('no_kp') is-invalid @enderror" id="no_kp" value="{{ $no_kp }}" readonly required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Tanggal</span>
                <input type="text" name='tanggal' class="form-control rounded-top @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="yyyy-mm-dd" required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Keterangan</span>
                <input type="text" name='keterangan' class="form-control rounded-top @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Keterangan" required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">File</span>
                <input type="file" name='file' class="form-control rounded-top @error('file') is-invalid @enderror" title="NIM_ProgressKP_Minggu ke-">
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Tambah</button>

        </form>
    @endif
</body>
@endsection