@extends('layouts.navbar')
<!-- 
<style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


@section('isi')
<body style="background-color: #D8E3E7;">
    @if (auth()->user()->level=='admin')
    <a href="/magang/unduhdatamagang" target="_blank" class="btn btn-success mx-3">Download Data</a>
    @endif
    @if (auth()->user()->level=='admin'||auth()->user()->level=='dosen')
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow-sm" style="height: 400px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center text-light" colspan="15" style="background-color: #008891;">Data Magang</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-light text-center" style="background-color: #008891;">
                    <td><b>Nama</b></td>
                    <td><b>NIM</b></td>
                    <td><b>Instansi</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Nilai</b></td>
                    @if (auth()->user()->level=='dosen')
                        <td><b>Laporan Akhir</b></td>
                        <td colspan="5"></td>
                    @endif
                    @if (auth()->user()->level=='admin')
                        <td colspan="2"><b>Fungsi</b></td>
                    @endif
                </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->instansi_magang}}</td>
                    <td>{{$post->keterangan}}</td>
                    <td>{{$post->nilai_akhir}}</td>

                    @if (auth()->user()->level=='admin')
                        <form method="GET" action="{{ url('magang/edit', $post->no_magang) }}">
                            @csrf
                        <td><button class="btn btn-primary col-12" type="submit">Edit</button></td>
                        </form>
                        
                        <form method="POST" action="{{ url('magang/delete', $post->no_magang) }}">
                            @csrf
                            @method('DELETE')
                        <td><button class="btn btn-primary col-12" type="submit">Hapus</button></td>
                        </form>
                    @endif

                    @if (auth()->user()->level=='dosen')
                        <td>{{$post->file}}</td>
                        <form method="GET" action="{{ url('magang/edit', $post->no_magang) }}">
                            @csrf
                        <td><button class="btn btn-primary col-12" type="submit">Nilai</button></td>
                        </form>

                        <form method="POST" action="{{ url('kp/laporan_unduh', $post->file) }}">
                            @csrf
                        <td><button class="btn btn-primary col-12" type="submit">Download</button></td>
                        </form>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    </div>


    @if ($ubah != Null && auth()->user()->level=='admin')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 240px;">
        <div class="badge fs-2 text-dark">Ubah Data</div>
        <form method="POST" action="{{ url('magang/update', $ubah->no_magang ) }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Nama</span>
                <input class="form-control col-9" name="nama" value="{{ $ubah->nama_mahasiswa }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">NIM</span>
                <input class="form-control col-9" name="nim" value="{{ $ubah->NIM }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Instansi</span>
                <input class="form-control col-9" name="instansi" value="{{ $ubah->instansi_magang }}" type="text">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_magang') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>

    @elseif ($ubah != Null && auth()->user()->level=='dosen')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 450px; height: 330px;">
        <div class="badge fs-2 text-dark">Beri Nilai Magang {{ $ubah->nama_mahasiswa }}</div>
        <form method="POST" action="{{ url('magang/update', $ubah->no_magang ) }}">
            @csrf
            <input name="nilai" value="{{ $ubah->nilai_akhir }}" type="text" style="width: 430px;">
           <button class="btn btn-primary mx-1 my-2"> <a href="{{ route('halaman_magang') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
            <button class="btn btn-primary mx-1 my-2" type="submit">Simpan</button>
        </form>
    </div>
    @endif

    @if (auth()->user()->level=='admin')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 260px;">
        <div class="badge fs-2 text-dark">Tambah Data</div>
        <form action="/magang" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="text" name='nama_mahasiswa' class="form-control rounded-top @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" placeholder="Nama" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='NIM' class="form-control rounded-top @error('NIM') is-invalid @enderror" id="NIM" placeholder="NIM" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='instansi_magang' class="form-control rounded-top @error('instansi_magang') is-invalid @enderror" id="instansi_magang" placeholder="Instansi Magang" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Tambah</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    @endif

    @if (auth()->user()->level=='mahasiswa')
        <a href="{{ route('daftar_magang') }}"><button class="btn-light btn-outline-info position-absolute top-50 start-50 mx-4 text-dark rounded" id="tombol" style="width: 28%; height:12%;">Data Magang</button></a>
        <a href="{{ route('form_magang') }}"><button class="btn-light btn-outline-info position-absolute top-50 end-50 mx-4 text-dark rounded" id="tombol" style="width: 28%; height:12%;">Form Magang</button></a>
    @endif
</body>
@endsection