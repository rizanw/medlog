{% extends "dashboard/base.volt" %}

{% block title %}Tambah Pasien{% endblock %}

{% block content %}

    <div class="home-content" align="center">
        <form style="padding: 25% 0px;" action="{{ url("dokter/tambahpasien") }}" method="post">
            <h3>Masukkan no. rekam medis pasien</h3>
            <div class="input-group">
                <div class="input-group-front">10/665/</div>
                <div class="input-group-ctn">
                    <input type="idpasien" name="idpasien" id="idpasien">
                </div>
                <div class="input-group-back">
                    <input type="submit" value="Tambah">
                </div>
            </div>
        </form>
    </div>
{% endblock %}