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
                <th class="text-center text-light" colspan="15" style="background-color: #008891;">Data User</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-light text-center" style="background-color: #008891;">
                <td><b>Email</b></td>
                <td><b>Nama</b></td>
                <td><b>Status</b></td>
                <td colspan="2"><b>Edit</b></td>
            </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{$post->email}}</td>
                <td>{{$post->nama}}</td>
                <td>{{$post->level}}</td>

                
                <form method="GET" action="{{ url('user/edit', $post->id) }}">
                    @csrf
                <td><button class="btn btn-primary col-12" type="submit">Edit</button></td>
                </form>
                
                <form method="POST" action="{{ url('user/delete', $post->id) }}">
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
    <div class="container mb-5 text-center bg-light rounded-3 shadow-sm" style="width: 430px; height: 240px;">
        <div class="badge fs-2 text-dark">Ubah Data</div>
        <form method="POST" action="{{ url('user/update', $ubah->id ) }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Email</span>
                <input class="form-control col-9" name="email" value="{{ $ubah->email }}" type="text">
            </div> 
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Nama</span>
                <input class="form-control col-9" name="nama" value="{{ $ubah->nama }}" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text col-3" id="basic-addon1">Status</span>
                <input class="form-control col-9" name="level" value="{{ $ubah->level }}" type="text">
            </div>
            <div class="btn-group my-2" role="group" aria-label="Basic example">
                <button class="btn btn-primary mx-1"><a href="{{ route('halaman_user') }}" style="color: white; text-decoration: NONE">Cancel</a></button>
                <button class="btn btn-primary mx-1" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    @endif

    <div class="container mb-5 text-center bg-light rounded-3 shadow-sm" style="width: 430px; height: 300px;">
        <div class="badge fs-2 text-dark">Tambah Data</div>
        <form action="/user" method="POST">
            @csrf
            <table>
                <tbody>
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
                            <input type="text" name='nama' class="form-control rounded-top @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" required style="width: 400px;">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='level' class="form-control rounded-top @error('level') is-invalid @enderror" id="level" placeholder="Status" required style="width: 400px;">
                            @error('level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required style="width: 400px;">
                            @error('password')
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