<?php

use Phalcon\Mvc\Model;

class Pemeriksaan extends Model
{
    public $idpemeriksaan;
    public $tglperiksa;
    public $pemeriksa;
    public $idpasien;
    public $anamnesa;
    public $objektif;
    public $assesment;
    public $planning;
    public $prognosis;
    public $keluhan;
    public $lab;
    public $icd10;
    public $filepenunjang;
    public $filetype;
    public $filesize;
    public $fileext;
    public $catatan;
}