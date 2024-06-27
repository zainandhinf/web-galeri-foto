<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Sign up</title>
</head>

<body>
    <section class="left">
        {{-- <img src="assets/img/gambarlogin.svg" alt="" class="img-side"> --}}
        <img src="assets/img/signup.jpg" alt="">
    </section>
    <section class="right">
        <div class="card card-1">
            <span class="title">Picgram</span>
            <form action="/signup" method="POST">
                @csrf
                <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" placeholder="Username"
                    aria-label="default input example" required>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password"
                    aria-label="default input example" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" placeholder="Email"
                    aria-label="default input example" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" type="text" placeholder="Nama Lengkap"
                    aria-label="default input example" required>
                @error('nama_lengkap')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                {{-- <input class="form-control" name="alamat" type="text" placeholder="Alamat"
                    aria-label="default input example"> --}}
                <button class="btn btn-primary submit" type="submit">Sign up</button>
            </form>
            <div class="p-3 d-flex">
                <span class="line"></span>
                <span class="fw-bold">OR</span>
                <span class="line"></span>
            </div>
        </div>
        <div class="card card-2">
            <span>Sudah punya akun? <a href="/login" class="fw-bold text-decoration-none">Log in</a></span>
        </div>
    </section>
</body>

</html>
