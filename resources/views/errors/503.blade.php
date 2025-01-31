<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website PKHKI Sedang dalam Perbaikan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
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

        .icon {
            font-size: 6rem;
            margin-bottom: 20px;
            animation: spin 3s infinite linear;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
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
        <i class="bi bi-tools icon"></i>
        <h1>Situs Sedang dalam Perbaikan</h1>
        <p>Kami sedang melakukan pemeliharaan sistem. Silakan kembali lagi nanti.</p>
    </div>
</body>
</html>
