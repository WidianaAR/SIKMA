@extends('layouts.navbar')

<!-- <style>
    table,
    td {border: 1px solid #333; text-align:center;}
    thead,tfoot {background-color: #222; color: #fff;}
    th{width: 50%; }
    button{background-color: #ff5346; color: #fff; border: none; border-radius: 2px;}
</style> -->

@section('isi')
<body>
@if (auth()->user()->level=='admin')
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered" style="border-color: black;">
            <thead>
                <tr>
                    <th colspan="8" style="background-color: #D8E3E7;">Data Magang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts_magang as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->instansi_magang}}</td>
                    <td>{{$post->keterangan}}</td>
                    
                    <form method="GET" action="{{ url('magang/edit', $post->no_magang) }}">
                        @csrf
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Edit</button></td>
                    </form>
                    
                    <form method="POST" action="{{ url('magang/delete', $post->no_magang) }}">
                        @csrf
                        @method('DELETE')
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Hapus</button></td>
                    </form>

                    <form method="POST" action="{{ url('magang/status', $post->no_magang ) }}">
                        @csrf
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Terima</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered" style="border-color: black;">
            <thead>
                <tr>
                    <th colspan="15" style="background-color: #D8E3E7;">Data KP</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Nama Mahasiswa</b></td>
                    <td><b>Dosen Pembimbing</b></td>
                    <td><b>NIM</b></td>
                    <td><b>Judul KP</b></td>
                    <td><b>Instansi</b></td>
                    <td><b>Jadwal Semhas</b></td>
                    <td><b>Keterangan</b></td>
                    <td colspan="5"><b>Fungsi</b></td>
                </tr>
                @foreach ($posts_kp as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->nama_dosen}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->judul_kp}}</td>
                    <td>{{$post->instansi_kp}}</td>
                    <td>{{$post->semhas}}</td>
                    <td>{{$post->keterangan}}</td>
                    
                    <form method="GET" action="{{ url('kp/edit', $post->no_kp) }}">
                        @csrf
                    <td><button class="btn btn-primary mx-1 col-12" type="submit">Edit</button></td>
                    </form>
                        
                    @if($post->status == 0)
                        <form method="POST" action="{{ url('kp/delete', $post->no_kp) }}">
                            @csrf
                            @method('DELETE')
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Hapus</button></td>
                        </form>

                        <form method="POST" action="{{ url('kp/status', $post->no_kp) }}">
                            @csrf
                            <td><button class="btn btn-primary mx-1 col-12" type="submit">Terima</button></td>
                        </form>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (auth()->user()->level=='mahasiswa')
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered" style="border-color: black;">
            <thead>
                <tr>
                    <th colspan="8" style="background-color: #D8E3E7;">Data Magang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts_magang as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->instansi_magang}}</td>
                    <td>{{$post->keterangan}}</td>
                    <td>{{$post->nilai_akhir}}</td>

                    <form method="POST" action="{{ url('magang/status', $post->no_magang ) }}">
                        @csrf
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Telah Dibaca</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <br><br>

    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered" style="border-color: black;">
            <thead>
                <tr>
                    <th colspan="15" style="background-color: #D8E3E7;">Data KP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts_kp as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->nama_dosen}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->judul_kp}}</td>
                    <td>{{$post->instansi_kp}}</td>
                    <td>{{$post->semhas}}</td>
                    <td>{{$post->keterangan}}</td>

                    <form method="POST" action="{{ url('kp/status', $post->no_kp ) }}">
                        @csrf
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Telah Dibaca</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if (auth()->user()->level=='dosen')
    <div class="row align-items-start text-light bg-white mt-2 mb-5 mx-3 overflow-auto shadow" style="height: 300px;">
        <table class="table table-bordered" style="border-color: black;">
            <thead>
                <tr>
                    <th colspan="15" style="background-color: #D8E3E7;">Permintaan Menjadi Dospem KP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts_kp as $post)
                <tr>
                    <td>{{$post->nama_mahasiswa}}</td>
                    <td>{{$post->nama_dosen}}</td>
                    <td>{{$post->NIM}}</td>
                    <td>{{$post->judul_kp}}</td>
                    <td>{{$post->instansi_kp}}</td>
                    <td>{{$post->semhas}}</td>
                    <td>{{$post->keterangan}}</td>

                    <form method="POST" action="{{ url('kp/dospem', $post->no_kp ) }}">
                        @csrf
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Terima</button></td>
                    </form>
                    <form method="POST" action="{{ url('kp/status', $post->no_kp ) }}">
                        @csrf
                        <td><button class="btn btn-primary mx-1 col-12" type="submit">Tolak</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</body>
@endsection