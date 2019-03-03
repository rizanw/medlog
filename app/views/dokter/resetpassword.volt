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
        <form action="{{ url("dokter/resetpassword") }}" method="post">
            <h1>Masukkan username</h1>
            <div class="form-group ">
                <input type="text" name="username" id="username" class="form-control form-logres" placeholder="username">
                <i class="fa fa-user"></i>
            </div>
            <h1>Masukkan password baru</h1>
            <div class="form-group ">
                <input type="password" name="password" id="password" class="form-control form-logres">
                <i class="fa fa-user"></i>
            </div>
            <h1>Masukkan token</h1>
            <div class="form-group ">
                <input type="text" name="token" id="token" class="form-control form-logres" placeholder="token">
                <i class="fa fa-user"></i>
            </div>
            <span class="alert">Invalid Credentials</span>
            <input type="submit" class="log-btn" value="Reset">
        </form>
        <p>
            Sudah terdaftar?<br>
            <a class="link" href="{{ url("dokter/login") }}"> Masuk disini, dokter! </a>
        </p>
    </div>
</div>
</body>
</html>