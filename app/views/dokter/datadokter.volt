{% extends "dashboard/base.volt" %}

{% block title %}Profil Dokter{% endblock %}

{% block content %}
    <div class="home-content">
        <label>Profile Dokter</label>
        <form class="data-form" action="{{ url("dokter/datadokter") }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <tr>
                <img src="data:image/jpg/png;base64,{{user.foto}}" height="140px;" />
                </tr>
                <br>

                <label for="username">Username : </label>
                {{ user.username }}
                <input type="hidden" name="username" id="username" value={{user.username}}> <br>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap </label><br>
                <input class="form-control" type="text" name="nama" id="nama" placeholder="(belum diisi)" value= {{ user.nama }}> <br>
            </div>
            <div class="form-group">
                <label for="spesialis">Spesialis </label><br>
                <input class="form-control" type="text" name="spesialis" id="spesialis" placeholder="(belum diisi)" value= {{ user.spesialis }}>
                <br>
            </div>
            <div class="form-group">
                <label for="tgllahir">Tanggal Lahir </label><br>
                <input class="form-control" type="date" name="tgllahir" id="tgllahir" placeholder="(belum diisi)" value= {{ user.tgllahir }}> <br>
            </div>
            <div class="form-group">
                {% if (user.jkel != NULL) %}
                    Jenis kelamin : {{ user.jkel }}
                {% else %}
                    <label for="jkel">Jenis kelamin </label> <br>
                    <input type="radio" name="gender" value="pria"> Pria
                    <input type="radio" name="gender" value="wanita"> Wanita <br>
                {% endif %}
            </div>
            <div class="form-group">
                <label for="telepon">Telepon </label><br>
                <input class="form-control" type="text" name="telepon" id="telepon" placeholder="(belum diisi)" value= {{ user.telepon }}> <br>
            </div>
            <div class="form-group">
                <label for="email">Email </label><br>
                <input class="form-control" type="text" name="email" id="email" placeholder="(belum diisi)" value= {{ user.email }}> <br>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat </label><br>
                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="(belum diisi)" value= {{ user.alamat }}> <br>
            </div>
            <div class="form-group">
                <label for="kota">Kota </label><br>
                <input class="form-control" type="text" name="kota" id="kota" placeholder="(belum diisi)" value= {{ user.kota }}> <br>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi </label><br>
                <input class="form-control" type="text" name="provinsi" id="provinsi" placeholder="(belum diisi)" value= {{ user.provinsi }}> <br>
            </div>
            <div class="form-group">
                <label for="alumni">Alumni :</label><br>
                <input class="form-control" type="text" name="alumni" id="alumni" placeholder="(belum diisi)" value= {{ user.alumni }}> <br>
            </div>

            <div class="form-group">
                <label for="foto">Foto </label><br>
                <input class="input-file" type="file" name="foto" id="fileToUpload" value= {{ user.foto }}> <br>
            </div>
            
            <input class="log-btn" type="submit" value="Perbarui Data">
        </form>
    </div>
{% endblock %}