@extends('layouts.navbar2')
@section('isi')
<div class="d-flex align-items-center" style="width:100%; height:100%; background-image: url('{{asset('img/home.png')}}'); background-size:1368px 575.09px; background-repeat: no-repeat">
  <div class="col-md-4" style="background-color:rgb(46, 65, 79, 0.8); margin-left:33%; color: white; height:45%; border-radius:10px">

    @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <main class="form-register">
    <h1 class="h3 mb-3 fw-bold text-center">Ganti Password</h1>
    <form action="/gantipass" method="POST">
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
          <input type="password" name="old_password" class="form-control rounded-bottom @error('old_password') is-invalid @enderror" id="old_password" placeholder="Password Lama" required>
          @error('old_password')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-floating">
        <div class="input-group">
          <div class="input-group">
          <input type="password" name="new_password" class="form-control rounded-bottom @error('new_password') is-invalid @enderror" id="new_password" placeholder="Password Baru" required>
          @error('new_password')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Submit</button>
        </div>
      </div>
    </form>
    <small>Back to <a href="/login" style="color: white">Login</a> </small>
    </main>
  </div>
</div>
@endsection
