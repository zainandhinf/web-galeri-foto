<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../../assets/css/profile.css">
    {{-- <link rel="stylesheet" href="assets/css/createpost.css"> --}}
    <link rel="stylesheet" href="assets/css/editalbum.css">
    <link rel="stylesheet" href="../assets/css/editalbum.css">
    <link rel="stylesheet" href="../../assets/css/editalbum.css">
    <link rel="stylesheet" href="assets/css/editprofile.css">
    <link rel="stylesheet" href="../assets/css/editprofile.css">
    <link rel="stylesheet" href="../../assets/css/editprofile.css">
    <link rel="stylesheet" href="assets/css/glider.min.css">
    <link rel="stylesheet" href="../assets/css/glider.min.css">
    <link rel="stylesheet" href="../../assets/css/glider.min.css">
    <link rel="stylesheet" href="assets/css/popuppost.css">
    <link rel="stylesheet" href="../assets/css/popuppost.css">
    <link rel="stylesheet" href="../../assets/css/popuppost.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="../../assets/css/search.css">
    {{-- <link rel="stylesheet" href="assets/masonry-docs/css/masonry-docs.css">
    <link rel="stylesheet" href="../assets/masonry-docs/css/masonry-docs.css"> --}}
    <script src="assets/js/glider.min.js"></script>
    <script src="assets/masonry-docs/js/masonry-docs.min.js"></script>
    <script src="../assets/masonry-docs/js/masonry-docs.min.js"></script>
    <script src="../../assets/masonry-docs/js/masonry-docs.min.js"></script>
    </body>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .content {
            margin-left: 87px;
        }
    </style>

</head>

<body>
    <div class="d-flex">
        <div>
            @include('partials.sidebar')
        </div>
        {{-- <span class="line-sidebar z-3 bg-secondary"></span> --}}
        <div class="content d-flex">
            @yield('content')
        </div>
    </div>

    <script src="assets/js/glider.min.js"></script>
    <script src="../assets/js/glider.min.js"></script>
    <script src="../../assets/js/glider.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/masonry-docs/js/masonry-docs.min.js"></script>
    <script src="../assets/masonry-docs/js/masonry-docs.min.js"></script>
    <script src="../../assets/masonry-docs/js/masonry-docs.min.js"></script>
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
