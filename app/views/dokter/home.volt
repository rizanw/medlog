{% extends "dashboard/base.volt" %}

{% block title %}Beranda{% endblock %}

{% block content %}
    <div class="dashboard-header" align="right">
        <button onclick="location.href = '{{ url('dokter/tambahpasien') }}';" style="background-color: #38b1eb">
            <i class="fas fa-user-plus"></i>
            <span> Pasien</span>
        </button>

        <div class="dropdown-btn" style="float: right;">
            <button><i class="fas fa-user-md"> </i> Profil</button>
            <div class="dropdown-ctn">
                <ul>
                    <li>
                        <a href="{{ url('dokter/datadokter') }}">
                            Akun
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dokter/logout') }}">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="home-content">
        <div class="dok-hello">
            <h1 style="padding: 0px 5px">
                Hallo, {{ session.get('auth')['username'] }}!
            </h1>
        </div>
        <div class="fbox-main">
            <div class="fbox-item stretc">
                item 1
            </div>
            <div class="fbox-item stretc">
                item 2
            </div>
            <div class="fbox-item stretc">
                item 3
            </div>
            <div class="fbox-item stretc">
                item 4
            </div>
        </div>
    </div>
{% endblock %}