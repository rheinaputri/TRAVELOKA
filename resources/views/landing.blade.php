<!-- resources/views/landing.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveloka - Jelajahi Dunia Bersama Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        body {
            position: relative;
            background-image: url('adminlte/dist/img/bg.jpg');
            background-size: cover;
            /* background-position: center; */
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 0;
        }

        body::before {
            content: "";
            position: fixed;
            /* biar ikut scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(3, 19, 32, 0.4);
            /* atur kegelapan di sini */
            z-index: -1;
            /* supaya tidak menutupi konten */
        }



        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: white !important;
            font-weight: 500;
            margin-right: 15px;
        }

        .landing-content {
            text-align: center;
            padding-top: 15%;
            **color: white;
            /* Tambahan: pastikan teks putih */
            **
        }

        .btn-custom {
            margin-top: 30px;
            padding: 10px 25px;
            font-size: 18px;
            border-radius: 60px;
            **border: none;
            /* Opsional biar lebih clean */
            ** **border-radius: 999px !important;
            /* Tambahan: biar benar-benar pill */
            **
        }


        /* navbar activee */
        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: white !important;
            font-weight: 500;
            margin-right: 15px;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .navbar a:hover {
            color: #3d444e !important;
            background-color: #bebebe !important;
            border-radius: 5px;
        }

        .navbar .nav-item .nav-link.active {
            background-color: #e0e0e0 !important;
            color: #323435 !important;
            border-radius: 5px;
        }

        .navbar .nav-item .nav-link.active:hover {
            background-color: #efefef !important;
        }

        .overflow-auto {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <<!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top py-2">
            <div class="container-fluid px-5">
                <a class="navbar-brand fw d-flex align-items-center" href="#">
                    <img src="{{ asset('adminlte/dist/img/logotravel.png') }}" alt="Logo"
                        style="height: 36px; margin-right: 12px;">
                    Traveloka
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
                                href="#">About Us</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request::is('destinasi*') ? 'active' : '' }}"
                                href="{{ route('destinasi.indexweb') }}">Destinasi</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request::is('paket*') ? 'active' : '' }}"
                                href="{{ route('paket.indexpaket') }}">Paket</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Bahasa</a></li>
                        <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="{{ route('login') }}">Login</a>
                    </ul>
                </div>
            </div>
        </nav>




        <!-- Landing Page Content -->
        <div class="landing-content container text-white"
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <h1 class="display-3 fw-bold">Selamat Datang di Traveloka</h1>
            <p class="lead" style="font-weight: 400;">
                Temukan pengalaman perjalanan terbaikmu bersama kami. Jelajahi destinasi impianmu
                dengan mudah dan cepat.
            </p>
            <br>
            <a href="{{ route('formpesan.index') }}" class="btn btn-light text-primary px-4 py-2 rounded-pill">
                Pesan Sekarang
            </a>
        </div>



        <!-- Tambahkan di <head> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Carousel -->
        <div class="container mt-5">
            <center><h3 class="text-white mb-4">Rekomendasi Destinasi</h3><center>
            <div id="multiCardCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach ([['img' => 'bali.jpg', 'title' => 'Bali'], ['img' => 'yogyakarta.jpg', 'title' => 'Yogyakarta'], ['img' => 'lombok.jpg', 'title' => 'Lombok'], ['img' => 'rajaampat.jpg', 'title' => 'Raja Ampat']] as $dest)
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div
                                        class="card bg-dark text-white mb-3 overflow-hidden position-relative border-0">
                                        <img src="{{ asset('adminlte/dist/img/' . $dest['img']) }}" class="card-img"
                                            alt="{{ $dest['title'] }}" style="height: 220px; object-fit: cover;">
                                        <div class="position-absolute bottom-0 start-0 w-100 px-3 py-2"
                                            style="background-color: rgba(0, 0, 0, 0.6);">
                                            <h5 class="card-title mb-0" style="font-size: 1.1rem;">{{ $dest['title'] }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row">
                            @foreach ([['img' => 'bromo.jpg', 'title' => 'Gunung Bromo'], ['img' => 'ijen.jpg', 'title' => 'Kawah Ijen'], ['img' => 'bali.jpg', 'title' => 'Bali'], ['img' => 'rajaampat.jpg', 'title' => 'Raja Ampat']] as $dest)
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div
                                        class="card bg-dark text-white mb-3 overflow-hidden position-relative border-0">
                                        <img src="{{ asset('adminlte/dist/img/' . $dest['img']) }}" class="card-img"
                                            alt="{{ $dest['title'] }}" style="height: 220px; object-fit: cover;">
                                        <div class="position-absolute bottom-0 start-0 w-100 px-3 py-2"
                                            style="background-color: rgba(0, 0, 0, 0.6);">
                                            <h5 class="card-title mb-0" style="font-size: 1.1rem;">{{ $dest['title'] }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#multiCardCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#multiCardCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>

        <!-- Tambahkan sebelum </body> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
