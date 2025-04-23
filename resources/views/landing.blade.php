<!-- resources/views/landing.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveloka - Jelajahi Dunia Bersama Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        }

        .btn-custom {
            margin-top: 30px;
            padding: 10px 25px;
            font-size: 18px;
            border-radius: 60px;
        }
    </style>
</head>

<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-6">
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
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Destinasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Paket</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Bahasa</a></li>
                    <li class="nav-item">
                        {{-- <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="#">Login</a> --}}
                        <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="{{ route('login') }}">Login</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Landing Page Content -->
    <div class="landing-content container">
        <h1 class="display-3 fw-bold">Selamat Datang di Traveloka</h1>
        <p class="lead">Temukan pengalaman perjalanan terbaikmu bersama kami. Jelajahi destinasi impianmu dengan mudah
            dan cepat.</p>

        <a href="/index" class="btn btn-light btn-custom text-primary">Pesan Sekarang</a>
    </div>
</body>

</html>
