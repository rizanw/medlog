<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url("img/favicon.ico") }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ url("img/favicon.ico") }}" type="image/x-icon"/>
    <link href="{{ url("css/logreg.css") }}" rel="stylesheet">
</head>
<body>
<div class="full-page" style="background: #43ADD9">
    <div class="login-form">
        <form action="{{ url("pasien/login") }}" method="post">
            <h1 style="text-align: center">Silakan Masuk</h1>
            <div class="form-group ">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                <i class="fa fa-user"></i>
            </div>
            <div class="form-group log-status">
                <input type="password" name="password" id="password" class="form-control" placeholder="Kata Sandi">
                <i class="fa fa-lock"></i>
            </div>
            <span class="alert">Invalid Credentials</span>
            <input type="submit" class="log-btn" value="Masuk">
        </form>
        <p>
            Belum terdaftar?
            <a class="link" href="{{ url("pasien/register") }}">
                <b>Daftar sekarang!</b>
            </a>
            <a class="link" href="{{ url("pasien/lupapassword") }}">
                <b>Lupa password?</b>
            </a>
        </p>
    </div>
</div>
</body>
</html>