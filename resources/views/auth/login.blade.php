<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #166694, #1e3c72, #293f96);

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .welcome-text {
            text-align: center;
            margin-top: 60px;
            margin-bottom: 30px;
        }

        .welcome-text h2 {
            font-weight: 600;
        }

        .welcome-text p {
            font-size: 1rem;
            color: #e0e0e0;
        }

        .login-box {
            max-width: 400px;
            margin: 0 auto 80px;
            padding: 35px 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .login-box h4 {
            color: white;
        }

        .login-box .form-control {
            height: 45px;
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .login-box .form-control::placeholder {
            color: #ddd;
        }

        .login-box .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.2);
            border: none;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="welcome-text">
        <h2>Selamat Datang Admin Traveloka</h2>
        <p>Silakan masuk untuk mengelola data wisata, paket, dan destinasi dengan mudah dan cepat.</p>
    </div>

    <div class="login-box">
        <h4 class="text-center mb-4"><i class="fas fa-user-shield"></i> Login Admin</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required
                    autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>

</body>

</html>
