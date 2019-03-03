{% extends "dashboard/base2.volt" %}

{% block title %}Dashboard | Pasien{% endblock %}

{% block content %}
    <div class="dashboard-header" align="right">
        <div class="dropdown-btn" style="float: right;">
            <button><i class="fas fa-user"> </i> Profil</button>
            <div class="dropdown-ctn">
                <ul>
                    <li>
                        <a href="{{ url('pasien/datapasien') }}">
                            Akun
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pasien/logout') }}">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="home-content">
        <p style="color:black">halo, {{ session.get('auth')['username'] }}</p>
        <p> nomor rekam medis : 10/665/{{ session.get('auth')['id'] }}</p>
    </div>
{% endblock %}