@extends('layouts.navbar')

<!-- <style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->


@section('isi')
<body style="background-color: #D8E3E7;">
    @if (auth()->user()->level=='admin')
        <a href="/kp/print" target="_blank" class="btn btn-success ms-3">Print</a>
        <a href="/kp/unduhdatakp" target="_blank" class="btn btn-success mx-1">Download Data</a>
    @endif
    @if (auth()->user()->level=='admin'||auth()->user()->level=='dosen')
        <!-- <div class="col-1 border text-center" style="background-color: #008891;">
            Jadwal Seminar
        </div> -->

    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow-sm" style="height: 400px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center text-light" colspan="15" style="background-color: #008891;">Data KP</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-light text-center" style="background-color: #008891;">
                    <td><b>Nama Mahasiswa</b></td>
                    <td><b>Dosen Pembimbing</b></td>
                    <td><b>NIM</b></td>
                    <td><b>Judul KP</b></td>
                    <td><b>Instansi</b></td>
                    <td><b>Jadwal Seminar</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Nilai Akhir</b></td>
                    @if (auth()->user()->level=='dosen')
                        <td><b>Laporan Akhir</b></td>
                        <td colspan="5"></td>
                    @endif
                    @if (auth()->user()->level=='admin')
                        <td colspan="5"><b>Fungsi</b></td>
                    @endif
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

                    @if (auth()->user()->level=='admin')
                        <form method="GET" action="{{ url('kp/edit', $post->no_kp) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Edit</button></td>
                        </form>

                        <form method="GET" action="{{ url('kp/dospem', $post->no_kp) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Dospem</button></td>
                        </form>

                        <form method="GET" action="{{ url('kp/semhas', $post->no_kp) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Seminar</button></td>
                        </form>
                        
                        <form method="POST" action="{{ url('kp/delete', $post->no_kp) }}">
                            @csrf
                            @method('DELETE')
                        <td><button class="btn btn-primary mx-1" type="submit">Hapus</button></td>
                        </form>
                    @endif

                    @if (auth()->user()->level=='dosen')
                        <td>{{$post->file}}</td>
                        <form method="GET" action="{{ url('kp/edit', $post->no_kp) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Nilai</button></td>
                        </form>

                        <form method="GET" action="{{ url('/progress_kp', $post->no_kp) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Progress</button></td>
                        </form>

                        <form method="POST" action="{{ url('kp/laporan_unduh', $post->file) }}">
                            @csrf
                        <td><button class="btn btn-primary mx-1" type="submit">Download</button></td>
                        </form>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if ($ubah_dospem != Null && auth()->user()->level=='admin' && $ubah_dospem->saran_dospem == Null)
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 200px;">
    
        <div class="badge fs-2 text-dark">Saran Dospem</div>
        <form method="POST" action="{{ url('kp/dospem', $ubah_dospem->no_kp ) }}">
            @csrf
            <select name="saran_dospem" class="form-control">
                <option value="">== Pilih Dosen ==</option>
                @foreach ($dosen as $dosen)
                    <option value="{{ $dosen->nama_dosen }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
            </select>
            <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_kp') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    @endif

    @if ($ubah_semhas != Null && auth()->user()->level=='admin')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 120px;">
        <div class="badge fs-2 text-dark">Jadwal Seminar</div>
        <form method="POST" action="{{ url('kp/semhas', $ubah_semhas->no_kp ) }}">
            @csrf
            <input name="semhas" value="{{ $ubah_semhas->semhas }}" type="text" placeholder="yyyy-mm-dd"> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_kp') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    @endif

    @if ($ubah != Null && auth()->user()->level=='admin')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 300px;">
        <div class="badge fs-2 text-dark">Ubah Data</div>
        <form method="POST" action="{{ url('kp/update', $ubah->no_kp ) }}">
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
                <span class="input-group-text col-3" id="basic-addon1">Judul</span>
                <input class="form-control col-9" name="judul" value="{{ $ubah->judul_kp }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Instansi</span>
                <input class="form-control col-9" name="instansi" value="{{ $ubah->instansi_kp }}" type="text">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_kp') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    @endif

    @if ($ubah != Null && auth()->user()->level=='dosen')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 240px;">
        <div class="badge fs-2 text-dark">Beri Nilai</div>
        <form method="POST" action="{{ url('kp/update', $ubah->no_kp ) }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Nilai</span>
                <input class="form-control col-9" name="nilai" value="{{ $ubah->nilai_akhir }}" type="text">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_kp') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    @endif

    @if (auth()->user()->level=='admin')
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 300px;">
        <div class="badge fs-2 text-dark">Tambah Data</div>
        <form action="/kp" method="POST">
            @csrf
            <table class="border-0">
                <tbody>
                    <tr>
                        <td><input type="text" name='nama_mahasiswa' class="form-control rounded-top @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" placeholder="Nama" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='NIM' class="form-control rounded-top @error('NIM') is-invalid @enderror" id="NIM" placeholder="NIM" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='judul_kp' class="form-control rounded-top @error('judul_kp') is-invalid @enderror" id="judul_kp" placeholder="Judul kp" required style="width: 400px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='instansi_kp' class="form-control rounded-top @error('instansi_kp') is-invalid @enderror" id="instansi_kp" placeholder="Instansi kp" required style="width: 400px;"></td>
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
        <a href="{{ route('daftar_kp') }}"><button class="btn-light btn-outline-info position-absolute top-50 start-50 mx-4 text-dark rounded" id="tombol" style="width: 28%; height:12%;" id="tombol">Data KP</button></a>
        <a href="{{ route('form_kp') }}"><button class="btn-light btn-outline-info position-absolute top-50 end-50 mx-4 text-dark rounded" id="tombol" style="width: 28%; height:12%;" id="tombol">Form KP</button></a>
    @endif
</body>
@endsection