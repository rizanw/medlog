{% extends "dashboard/base.volt" %}

{% block title %}Periksa{% endblock %}

{% block content %}
    <div class="home-content">
        <label>Formulir Pemeriksaan</label>
        <form class="data-form" action="{{ url("dokter/storeperiksa") }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idpasien" id="idpasien" value= {{ pasien2.idpasien }}> <br>
            <div class="form-group">
                <label for="tglperiksa">Tanggal Periksa</label><br>
                <input class="form-control" type="date" name="tglperiksa" id="tglperiksa">
            </div>
            <div class="form-group">
                <label for="anamnesa">anamnesa</label><br>
                <input type="text" name="anamnesa" id="anamnesa">
            </div>
            <div class="form-group">
                <label for="objektif">objektif</label><br>
                <input type="text" name="objektif" id="objektif">
            </div>
            <div class="form-group">
                <label for="assesment">assesment</label><br>
                <input type="text" name="assesment" id="assesment">
            </div>
            <div class="form-group">
                <label for="planning">planning</label><br>
                <input type="text" name="planning" id="planning"> <br>
            </div>
            <div class="form-group">
                <label for="prognosis">prognosis</label><br>
                <input type="text" name="prognosis" id="prognosis">
            </div>
            <div class="form-group">
                <label for="keluhan">keluhan</label><br>
                <input type="text" name="keluhan" id="keluhan"> <br>
            </div>
            <div class="form-group">
                <label for="lab">hasil lab</label><br>
                <input type="text" name="lab" id="lab"> <br>
            </div>
            <div class="form-group">
                <label for="icd10">icd 10</label><br>
                <input type="text" name="icd10" id="icd10"> <br>
            </div>

            <div class="form-group">
                <label for="fupload">File Penunjang </label><br>
                <input class="input-file" type="file" name="fupload" id="fupload"> <br>
            </div>

            <input class="log-btn" type="submit" value="Simpan">
        </form>
    </div>

{% endblock %}