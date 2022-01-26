<link rel="stylesheet" href="/css/styles.css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="row justify-content-center">
  <div class="col-md-4 mt-5">
    <main class="form-register">
    <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
    <form action="/register" method="POST">
        @csrf
      <div class="form-floating">
        <input type="email" name='email' class="form-control rounded-top @error('email') is-invalid @enderror" id="email" placeholder="Email" required>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="text" name='nama' class="form-control rounded-top @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" required>
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="form-floating">
        <input type="text" name='level' class="form-control rounded-top @error('level') is-invalid @enderror" id="level" placeholder="Level" required>
        @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Submit</button>
      </div>
    </form>
    <small>Have Account? <a href="/login">Login</a> </small>
    </main>
  </div>
</div>
