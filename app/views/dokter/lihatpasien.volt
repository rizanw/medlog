{% extends "dashboard/base.volt" %}

{% block title %}Daftar Pasien{% endblock %}

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
        <h2 class="dashboard-title">Daftar Pasien</h2>
        <div id="daftar-pasien"></div>
    </div>

    <script>
        var table = new Tabulator("#daftar-pasien", {
            height: "311px",
            layout: "fitColumns",
            placeholder: "Tidak Ada Pasien",
            columns: [
                {title: "No", field: "no", formatter: "rownum", width: 10},
                {title: "No Rekam Medis", field: "id"},
                {title: "Nama Pasien", field: "nama"},
                {title: "Jenis Kelamin", field: "jkel"},
                {
                    title: "Lihat", field: "link", formatter: "link", formatterParams: {
                        labelField: "name",
                        label: "Lihat",
                        urlPrefix: "{{ url('dokter/detailpasien/') }}",
                        target: "_blank",
                    }
                },
                {
                    title: "Hapus", field: "link", formatter: "link", formatterParams: {
                        labelField: "name",
                        label: "Hapus",
                        urlPrefix: "{{ url('dokter/hapuspasien/') }}",
                        // target: "_blank",
                    }
                }
            ],
        });
        table.setData("{{ url('dokter/lihatpasiendata') }}");
    </script>
{% endblock %}