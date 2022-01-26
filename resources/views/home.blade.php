@extends('layouts.navbar')

@section('isi')
<body style="background-color: #D8E3E7;">
    <div class="text-center mt-2 mb-5 mx-3" style="height: 300px;">
      @if (auth()->user()->level=='admin')
        <a href="{{ url('user') }}"><img src="{{URL::asset('/img/user.png')}}" width="20%" style="margin-right:50px"></a>
        <a href="{{ url('dosen') }}"><img src="{{URL::asset('/img/dosen.png')}}" width="20%"></a>
      @endif
      @if (auth()->user()->level=='admin' || auth()->user()->level=='dosen')
        <br>
        <a href="{{ url('mahasiswa') }}"><img src="{{URL::asset('/img/mahasiswa.png')}}" width="20%" style="margin-right:50px"></a>
      @endif
      <a href="{{ url('magang') }}"><img src="{{URL::asset('/img/magang.png')}}" width="20%"></a>
      <br>
      <a href="{{ url('kp') }}"><img src="{{URL::asset('/img/kp.png')}}" width="20%"></a>
    </div>
</body>
@endsection