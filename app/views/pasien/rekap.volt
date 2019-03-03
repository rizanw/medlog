{% extends "dashboard/base2.volt" %}

{% block title %}Daftar Pasien{% endblock %}

{% block content %}
    <div class="home-content">
      
        <div id="daftar-pasien"></div>
    </div>

    <script>
        var table = new Tabulator("#daftar-pasien", {
            height: "311px",
            layout: "fitColumns",
            placeholder: "No Data Set",
            columns: [
                {title: "No", field: "no", formatter: "rownum", width: 10},
                {title: "tanggal", field: "tglpemeriksaan"},
                {title: "keluhan", field: "keluhan"},
                
            ],
        });
        table.setData("{{ url('pasien/rekapdata') }}");
    </script>
{% endblock %}