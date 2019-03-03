{% extends "dashboard/base.volt" %}

{% block title %}Rekam Medis{% endblock %}

{% block content %}
    <div class="home-content">   
	tanggal periksa : {{data.tglperiksa}} <br>
    anamnesa : {{data.anamnesa}} <br>
    objektif : {{data.objektif}} <br>
    assesment : {{data.assesment}} <br>
    planning : {{data.planning}} <br>
    prognosis : {{data.prognosis}} <br>
    keluhan : {{data.keluhan}} <br>
    hasil lab : {{data.lab}} <br>
    icd 10 : {{data.icd10}} <br>
    file penunjang:<br>
    <a href="download/{{data.idpemeriksaan}}">download</a>
    
    <a href="{{ url('dokter/lihatpasien') }}">back</a>
       
{% endblock %}