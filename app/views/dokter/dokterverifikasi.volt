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
        <form action="{{ url("dokter/dokterverifikasi") }}" method="post">
            <h1>Masukkan token</h1>
            <h3>Cek email anda</h3>
            <div class="form-group ">
                <input type="token" name="token" id="token" class="form-control form-logres" placeholder="token">
                <i class="fa fa-user"></i>
            </div>

            <span class="alert">Invalid Credentials</span>
            <input type="submit" class="log-btn" value="Submit">
        </form>
    </div>
</div>
</body>
</html>