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
<div class="full-page" style="background: #27D293">
    <div class="login-form">
        <form action="{{ url("pasien/lupapassword") }}" method="post">
            <h1>Lupa Password?</h1>
            <div class="form-group ">
                <h1>Masukkan username</h1>
                <input type="text" name="username" id="username" class="form-control form-logres" placeholder="username">
                <i class="fa fa-user"></i>
            </div>
            <span class="alert">Invalid Credentials</span>
            <input type="submit" class="log-btn" value="Submit">
        </form>
        <p>
            Sudah terdaftar?<br>
            <a class="link" href="{{ url("pasien/login") }}"> Masuk disini! </a>
        </p>
    </div>
</div>
</body>
</html>