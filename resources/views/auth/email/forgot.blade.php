<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .email-wrapper {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h2 {
            color: #000000;
            margin-bottom: 15px;
        }

        p {
            color: #000000;
            margin-bottom: 15px;
        }

        .cta-button {
            background-color: #007bff;
            padding: 15px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .footer {
            color: #777;
            margin-top: 30px;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="email-wrapper">
            <img src="https://i.ibb.co/qrKCKfT/logo.png" alt="Logo" class="logo">
            <h2>Reset Password</h2>
            <p>Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.</p>
            <a href="{{ route('password.show', $token) }}" class="cta-button">Reset Password</a>
            <p>Tautan tersebut akan expired dalam 60 menit. Jika Anda tidak meminta pengaturan ulang kata sandi, Anda
                dapat mengabaikan email ini dan kata sandi Anda tetap aman.</p>
            <p>Terima kasih,</p>
            <p class="footer">Sejahtera.id</p>
        </div>
    </div>
</body>

</html>
