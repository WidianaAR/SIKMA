@extends('layouts.navbar')

<!-- <style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



@section('isi')
<body style="background-color: #D8E3E7;">
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow-sm" style="height: 400px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center text-light" colspan="15" style="background-color: #008891;">Data Dosen</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-light text-center" style="background-color: #008891;">
                    <td><b>Nama</b></td>
                    <td><b>Email</b></td>
                    <td><b>NIP</b></td>
                    <td><b>Jurusan</b></td>
                    <td><b>Telp</b></td>
                    <td colspan="2"><b>Edit</b></td>
                </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->nama_dosen}}</td>
                    <td>{{$post->email}}</td>
                    <td>{{$post->NIP}}</td>
                    <td>{{$post->jurusan}}</td>
                    <td>{{$post->telp}}</td>
                    
                    <form method="GET" action="{{ url('dosen/edit', $post->nama_dosen) }}">
                        @csrf
                    <td><button class="btn btn-primary col-12" type="submit">Edit</button></td>
                    </form>
                    
                    <form method="POST" action="{{ url('dosen/delete', $post->nama_dosen) }}">
                        @csrf
                        @method('DELETE')
                    <td><button class="btn btn-primary col-12" type="submit">Hapus</button></td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if ($ubah!=Null)
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 430px; height: 320px;">
        <div class="badge fs-2 text-dark">Ubah Data</div>
        <form method="POST" action="{{ url('dosen/update', $ubah->nama_dosen ) }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Nama</span>
                <input class="form-control col-9" name="nama_dosen" value="{{ $ubah->nama_dosen }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Email</span>
                <input class="form-control col-9" name="email" value="{{ $ubah->email }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">NIP</span>
                <input class="form-control col-9" name="NIP" value="{{ $ubah->NIP }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Jurusan</span>
                <input class="form-control col-9" name="jurusan" value="{{ $ubah->jurusan }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Telp</span>
                <input class="form-control col-9" name="telp" value="{{ $ubah->telp }}" type="text">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_dosen') }}">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
        
    </div>
    @endif
    <div class="container mb-5 bg-light text-center rounded-3 shadow-sm" style="width: 430px; height: 350px;">
        <div class="badge fs-2 text-dark">Tambah Data</div>
        <form action="/dosen" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name='nama_dosen' class="form-control rounded-top @error('nama_dosen') is-invalid @enderror" id="nama_dosen" placeholder="Nama" required style="width: 400px;">
                            @error('nama_dosen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name='email' class="form-control rounded-top @error('email') is-invalid @enderror" id="email" placeholder="Email" required style="width: 400px;">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='NIP' class="form-control rounded-top @error('NIP') is-invalid @enderror" id="NIP" placeholder="NIP" required style="width: 400px;">
                            @error('NIP')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='jurusan' class="form-control rounded-top @error('jurusan') is-invalid @enderror" id="jurusan" placeholder="Jurusan" required style="width: 400px;">
                            @error('jurusan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='telp' class="form-control rounded-top @error('telp') is-invalid @enderror" id="telp" placeholder="No.Telp" required style="width: 400px;">
                            @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Tambah</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
@endsection