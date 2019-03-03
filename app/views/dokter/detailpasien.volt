{% extends "dashboard/base.volt" %}

{% block title %}Detail Pasien{% endblock %}

{% block content %}
    <div class="home-content">
        <div class="profil-content" style="border: 1px solid green">
            <div class="profil-pict inline">
                
                <br>
                <i class></i>
            </div>
            <div class="inline profil-info">
                <table>
                        <tr>
                            <img src="data:image/jpg/png;base64,{{pasien.foto}}" height="140px;" />
                            </tr>
                    <tr>
                        <td class="title">Nama:</td>
                        <td>{{ pasien.nama }}</td>
                    </tr>
                    <tr>
                        <td class="title">NIK:</td>
                        <td>{{ pasien.nik }}</td>
                    </tr>
                    <tr>
                        <td class="title">Tanggal Lahir:</td>
                        <td>{{ pasien.tgllahir }}</td>
                    </tr>
                    <tr>
                        <td class="title">Jenis Kelamin:</td>
                        <td>{{ pasien.jkel }}</td>
                    </tr>
                    <tr>
                        <td class="title">Alamat:</td>
                        <td>{{ pasien.alamat }}</td>
                    </tr>
                    <tr>
                        <td class="title">Telp:</td>
                        <td>{{ pasien.telepon }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <h3 style="margin-bottom: 5px">Menu</h3>
            <div style="margin-bottom: 8px" class="fbx-container">
                <button onclick="location.href = '{{ url('dokter/detailpasien/') }} {{ pasien.idpasien }} {{ '/periksa' }}';" style="background-color: #38b1eb">
                    <i class="fas fa-user-plus"></i>
                    <span> Periksa Pasien</span>
                </button>
            </div>
        </div>

        

        <div id="riwayat-pasien"></div>
    </div>
    <script>
        var table = new Tabulator("#riwayat-pasien", {
            height: "311px",
            layout: "fitColumns",
            placeholder: "Tidak Ada Riwayat",
            columns: [
                {title: "No", field: "no", formatter: "rownum", width: 10},
                {title: "Tanggal", field: "tgl"},
                {title: "Keluhan", field: "keluhan"},
                {title: "Prognosis", field: "prognosis"},
                {
                    title: "Lihat", field: "link", formatter: "link", formatterParams: {
                        labelField: "lihat",
                        label: "Lihat",
                         urlPrefix: "{{ url('dokter/rekammedis/') }}",
//                        urlPrefix: "{{ url('rekammedis/') }}",
                        target: "_blank",
                    }
                },
            ],
        });
        table.setData("{{ url('dokter/detailpasiendata/') }}{{ pasien.idpasien }}");
    </script>
{% endblock %}