<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="margin: 0; padding: 20px; text-align: center; font-family: Arial, sans-serif;">

    <div style="max-width: 400px; background-color: #1C305E; color: white; padding: 20px; border-radius: 10px; margin: auto;">
        <h2 style="margin-bottom: 20px; color: white;">PKHKI - Newsletter - Email Verification</h2>
        <h2 style="margin-bottom: 20px; color: rgb(146, 146, 146);">{{ $otp }}</h2>
        <p style="margin-bottom: 20px; color: white;">Copy kode OTP yang anda terima dan masukkan pada link di bawah ini:</p>

        <a href="{{ url('/newsletter/verify/' . $email) }}" 
           style="display: inline-block; background-color: black; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">
           Verify
        </a>

        <p style="margin-top: 20px; font-size: 12px; opacity: 0.8; color: white;">Jika Anda sudah melakukan verifikasi email untuk berlangganan newsletter dari PKHKI, abaikan email ini.</p>
    </div>

</body>
</html>
