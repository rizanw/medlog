<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends Controller
{
    public function indexAction()
    {
        $_isDokter = $this->session->get('auth')['tipe'];
        if ($_isDokter == 2){
            return $this->response->redirect('pasien/home');
        }elseif($_isDokter == 1){
            return $this->response->redirect('dokter/home');
        }
    }

    public function show404Action()
    {

    }


}