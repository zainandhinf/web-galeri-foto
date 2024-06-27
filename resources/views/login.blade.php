<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Log in</title>
</head>

<body>
    {{-- @if (session()->has('success'))
        <div class="alert alert-success alert-dimissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-4 me-4 position-absolute end-0" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('logerror'))
        <div class="alert alert-danger alert-dimissible fade show mt-4 me-4 position-absolute end-0" role="alert">
            {{ session('logerror') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="left">
        {{-- <img src="assets/img/gambarlogin.svg" alt="" class="img-side"> --}}
        <img src="assets/img/login.jpg" alt="">
    </section>
    <section class="right">
        <div class="card card-1">
            <span class="title">Picgram</span>
            <form action="/login" method="POST">
                @csrf
                <input class="form-control" name="username" type="text" placeholder="Username"
                    aria-label="default input example" required>
                <input class="form-control" name="password" type="password" placeholder="Password"
                    aria-label="default input example" required>
                <button class="btn btn-primary submit" type="submit">Log in</button>
            </form>
            <div class="p-3 d-flex">
                <span class="line"></span>
                <span class="fw-bold">OR</span>
                <span class="line"></span>
            </div>
        </div>
        <div class="card card-2">
            <span>Belum punya akun? <a href="/signup" class="fw-bold text-decoration-none">Sign Up</a></span>
        </div>
    </section>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        const alertElement = document.querySelector(".alert");
        alertElement.classList.add("show");

        // Set timeout untuk menutup alert setelah 1 detik
        setTimeout(() => {
            // Tambahkan animasi fade out
            alertElement.classList.remove("show");
            alertElement.classList.add("fade");

            // Tunggu animasi fade out selesai, lalu hilangkan alert dari DOM
            setTimeout(() => {
                alertElement.remove();
            }, 3000); // Ubah angka timeout sesuai kebutuhan durasi animasi fade out
        }, 2000); // Ubah angka timeout sesuai kebutuhan waktu tampilan alert
    </script>
</body>

</html>
