<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <style>
        /* Animasi gradasi */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 0%;
            }
            100% {
                background-position: 100% 100%;
            }
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #1c305e, #2c4b8a);
            background-size: 200% 200%;
            animation: gradientAnimation 5s infinite alternate;
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 10rem;
            font-weight: bold;
        }

        p {
            font-size: 1.5rem;
        }

        .btn-home {
            padding: 12px 25px;
            font-size: 1.2rem;
            background-color: white;
            color: #1c305e;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-home:hover {
            background-color: #f8f9fa;
            color: #1c305e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! Halaman yang Anda cari tidak ditemukan.</p><br>
        <a href="#" onclick="history.back()" class="btn-home">Kembali</a>
    </div>
</body>
</html>
