{% extends "dashboard/base2.volt" %}

{% block title %}Profil Pasien{% endblock %}

{% block content %}
    <div class="home-content">
        <label>Profil Saya</label>
        <form class="data-form" action="{{ url("pasien/datapasien") }}" method="post" enctype="multipart/form-data">
            <tr>
            <img src="data:image/jpg/png;base64,{{user.foto}}" height="140px;" />
             </tr>
            <div class="form-group">
                <label for="username">Username : </label>
                {{ user.username }}
                <input type="hidden" name="username" id="username" value= {{ user.username }}> <br>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label><br>
                <input class="form-control" type="text" name="nik" id="nik" value= {{ user.nik }}> <br>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label><br>
                <input class="form-control" type="text" name="nama" id="nama" value= {{ user.nama }}> <br>
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input class="form-control" type="text" name="email" id="email" value= {{ user.email }}> <br>
            </div>

            <div class="form-group">
                <label for="tgllahir">Tanggal Lahir</label><br>
                <input class="form-control" type="date" name="tgllahir" id="tgllahir" value= {{ user.tgllahir }}> <br>
            </div>
            <div class="form-group">
                {% if (user.jkel != NULL) %}
                    Jenis kelamin : {{ user.jkel }}
                {% else %}
                    <label for="jkel">Jenis kelamin : </label> <br>
                    <input type="radio" name="gender" value="pria"> Pria
                    <input type="radio" name="gender" value="wanita"> Wanita <br>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="alamat">Alamat </label><br>
                <input class="form-control" type="text" name="alamat" id="alamat" value= {{ user.alamat }}> <br>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon </label><br>
                <input class="form-control" type="text" name="telepon" id="telepon" value= {{ user.telepon }}> <br>
            </div>

            <div class="form-group">
                <label for="provinsi">pekerjaan</label><br>
                <input class="form-control" type="text" name="pekerjaan" id="provinsi" value= {{ user.pekerjaan }}> <br>
            </div>
            <div class="form-group">
                <label for="foto">Foto </label><br>
                <input class="input-file" type="file" name="foto" id="foto" value= {{ user.foto }}> <br>   
            </div>
            <input class="log-btn" type="submit" value="Perbarui Data">
        </form>
    </div>
{% endblock %}