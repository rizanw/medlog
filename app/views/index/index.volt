{% extends "layouts/base.volt" %}

{% block title %}Rekam Medis Online Indonesia{% endblock %}

{% block content %}
    {% include 'layouts/navbar.volt' %}
    <div class="full-page" style="position: static!important;">
        <div class="page-content">
            <h1 align="center">
                <img src="{{ url('img/full-logo.png') }}" style="max-width: 380px">
            </h1>
            <h1 align="center">
                <b>
                    Rekam Medis Online Berbasis Cloud
                </b>
            </h1>
            <h3 align="center">
                Simpan informasi kesehatan Anda
                di satu tempat dengan aman.
            </h3>
        </div>
    </div>
    <div class="full-page" style="background-color: #048CE9">
        <div class="page-content">

            <div class="lb-page-ctn">
                <h1>Fitur-fitur</h1>
            </div>
            <div class="fbox-main fitur">
                <div class="fbox-item">
                    <i class="fas fa-cloud fa-4x"></i><br>
                    <label>Berbasis Cloud</label>
                    <p>Data dapat selalu diakses kapan saja dan dimana saja</p>
                </div>
                <div class="fbox-item">
                    <i class="fas fa-sync fa-4x"></i><br>
                    <label>Sinkronisasi</label>
                    <p>Data dapat disinkron. untuk memudahkan
                    dokter dalam melakukan diagnosis.</p>
                </div>
                <div class="fbox-item">
                    <i class="fas fa-lock fa-4x"></i><br>
                    <label>Berbasis Cloud</label>
                    <p>Data tersimpan dengan aman.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="full-page">
        <div style="border-color: #000; color: #000" class="lb-page-ctn">
            <h1>Pengguna</h1>
        </div>
        <div class="split-page left">
            <div class="pengguna dokter">
                <i class="fas fa-user-md fa-10x"></i><br>
                <label><b>Dokter</b></label>
                <p>Sebagai Seorang dokter, kami membutuhkan
                    data riwayat pasien untuk melakukan terapi
                    maupun diagnosis yang tepat dan efisien.</p>
            </div>
        </div>
        <div class="split-page right">
            <div class="pengguna pasien">
                <i class="fas fa-user fa-10x"></i><br>
                <label><b>Pasien</b></label>
                <p>Sebagai Seorang pasien, kami mengininkan untuk
                mendapat kualitas kesehatan yang lebih optimal lagi.
                Selain itu, kami ingin data kesehatan kami tersimpan
                dengan aman.</p>
            </div>
        </div>
    </div>
    <div class="full-page" style="background-color: #36C4C1; color: #fff;">
        <div class="page-content">
            <div style="border-color: #fff; color: #fff" class="lb-page-ctn">
                <h1>Team</h1>
            </div>
            <div style="padding-top: 30px;">
                <div class="split-page left team-page">
                    <img style="float: right" src="{{ 'img/tem.jpg' }}" width="500px">
                </div>
                <div class="split-page right team-page">
                    <div class="team-page-text">
                        <p style="font-size: 16pt">
                            Halo, kami adalah sekumpulan anak muda yang berasal dari Surabaya dan ingin menjadi solusi
                            dari
                            masalah-masalah kesehatan di negeri ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p align="center">Copyright &copy; 2018 — <a href="{{ url() }}" style="text-decoration: none; color: #ea194b">MedLog</a>
        </p>
    </div>
{% endblock %}