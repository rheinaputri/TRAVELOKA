<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveloka - Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.10.21/css/dataTables.bootstrap4.min.css">

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <style>
        body {
            background-image: url('/adminlte/dist/img/bg.jpg');
            background-size: cover;
            color: #2f2d2d;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 20px;
            padding-top: 100px;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(3, 19, 32, 0.4);
            z-index: -1;
        }

        .table-container {
            width: 95%;
            max-width: 1600px;
            margin: auto;
            background-color: rgb(201, 201, 201, 0.6);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .table-container h3 {
            color: #124075;
            text-align: center;
            margin-bottom: 25px;
        }

        .table thead th {
            background-color: #0e5a86;
            color: white;
            text-align: center;
            font-weight: 600;
        }

        .table td,
        .table th {
            padding: 12px 16px;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #d1e7fd;
            transition: all 0.3s ease-in-out;
            transform: scale(1.02);
        }

        .table tbody td {
            background-color: white;
            color: #000;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .alert {
            max-width: 1000px;
            margin: 10px auto;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 30px;
        }

        .dataTables_wrapper div.dataTables_filter input,
        .dataTables_wrapper div.dataTables_length select,
        .dataTables_wrapper div.dataTables_info {
            color: black !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #124075 !important;
            color: #fff !important;
            border-radius: 5px;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar a {
            color: white !important;
            font-weight: 500;
            margin-right: 15px;
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
    </style>
</head>

<body>

    <!-- Navbar -->
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

    <!-- Table Container -->
    <div class="table-container">
        <h3>Pemesanan</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('formpesan/create_ajax') }}')"
                class="btn btn-sm btn-primary mt-1 ms-auto d-block">Tambah Data</button>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>

        <table class="table table-bordered" id="table_pemesanan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Wisatawan</th>
                    <th>Nama Kota</th>
                    <th>Nama Paket</th>
                    <th>Jumlah Orang</th>
                    <th>Tanggal Berangkat</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>

    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            $('#table_pemesanan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('pemesanan/list') }}",
                    dataType: "json",
                    type: "GET"
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "wisatawan.nama_wisatawan",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kota.nama_kota",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "paket.nama_paket",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jumlah_orang",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_berangkat",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_kembali",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

</body>

</html>
