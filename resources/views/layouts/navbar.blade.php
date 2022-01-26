<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles1.css"/>
    <link rel="stylesheet" href="/css/styles.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SIKMA</title>
    @livewireStyles
    @livewireScripts
  </head>

  <body>  
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    @livewire('navbar')
    
    <div class="sidenav">
      <h5 class="nav-item">{{ auth()->user()->nama }}</h5>
      <a href="{{ url('home') }}">Home</a>
      @if (auth()->user()->level=='admin')
        <a href="{{ url('user') }}">User</a>
        <a href="{{ url('dosen') }}">Dosen</a>
      @endif
      @if (auth()->user()->level=='admin' || auth()->user()->level=='dosen')
        <a href="{{ url('mahasiswa') }}">Mahasiswa</a>
      @endif
      <a href="{{ url('magang') }}">Magang</a>
      <a href="{{ url('kp') }}">KP</a>
      <a href="{{ route('signout') }}">Logout</a>
    </div>

    <div class="main">
      @yield('isi')
    </div>
    <br>
    
    <footer class="page-footer font-small" style="background-color: #000000;">
      <br>
    </footer>
  </body>
</html>