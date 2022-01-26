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
    <div class="container mb-5 text-center rounded-3 bg-light shadow-sm" style="width: 500px; height: 280px;">
        <div class="badge fs-2 text-dark">Daftar KP</div>
        <form action="/kp" method="POST">
            @csrf
            <div class="input-group">
                <span class="input-group-text col-2" id="basic-addon1">Nama</span>
                <input type="text" name='nama_mahasiswa' class="form-control rounded-top @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" placeholder="Nama" required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-2" id="basic-addon1">NIM</span>
                <input type="text" name='NIM' class="form-control rounded-top @error('NIM') is-invalid @enderror" id="NIM" placeholder="NIM" required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-2" id="basic-addon1">Judul</span>
                <input type="text" name='judul_kp' class="form-control rounded-top @error('judul_kp') is-invalid @enderror" id="judul_kp" placeholder="Judul KP" required>
            </div>
            <div class="input-group">
                <span class="input-group-text col-2" id="basic-addon1">Instansi</span>
                <input type="text" name='instansi_kp' class="form-control rounded-top @error('instansi_kp') is-invalid @enderror" id="instansi_kp" placeholder="Instansi KP" required>
            </div>
            <div class="btn-group my-3" role="group" aria-label="Basic example" style="width: 400px; height:auto">
                <button class="btn btn-primary mx-1 rounded col" type="reset">Batal</button>
                <button class="btn btn-primary mx-1 rounded col" type="submit">Ajukan KP</button>
            </div>
        </form>
    </div>
</body>
@endsection