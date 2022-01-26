@extends('layouts.navbar2')
@section('isi')
<div class="d-flex align-items-center" style="width:100%; height:100%; background-image: url('{{asset('img/home.png')}}'); background-size:1368px 575.09px; background-repeat: no-repeat">
  <div class="col-md-4" style="background-color:rgb(46, 65, 79, 0.8); margin-left:33%; color: white; height:40%; border-radius:10px">

    {{-- box alert setelah register --}}
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <main class="form-signin">
    <h1 class="h3 mb-3 fw-bold text-center">Please Login</h1>
    <form action="/login" method="POST">
      @csrf
      <div class="form-floating">
        <div class="input-group">
            <input type="email" name='email' class="form-control rounded-top @error('email') is-invalid @enderror" id="email" placeholder="Email" required>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
      </div>
    
      <div class="form-floating">
        <div class="input-group">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
          @error('password')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
        </div>
      </div>
    </form>
    <small>Click here to <a href="/gantipass" style="color: white">Change Password</a> </small>
    </main>
  </div>
</div>
@endsection