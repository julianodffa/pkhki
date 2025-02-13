<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 20px; text-align: center; font-family: Arial, sans-serif;">

    <div style="max-width: 400px; background-color: #1C305E; color: white; padding: 20px; border-radius: 10px; margin: auto;">
        <h2 style="margin-bottom: 20px; color: white;">PKHKI - Reset Password</h2>
        <p style="margin-bottom: 20px; color: white;">Kami menerima permintaan untuk mengatur ulang password akun Anda. Silakan klik tombol di bawah ini untuk melanjutkan:</p>

        <a href="{{ url('/reset-password/' . $token) }}" 
           style="display: inline-block; background-color: black; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">
           Reset Password
        </a>

        <p style="margin-top: 20px; font-size: 12px; opacity: 0.8; color: white;">Jika Anda tidak meminta reset password dari website, abaikan email ini.</p>
    </div>

</body>
</html>
