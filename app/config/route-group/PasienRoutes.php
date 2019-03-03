<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class PasienRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'pasien',
        ]);

        $this->setPrefix('/pasien');

        $this->addGet(
            '/register',
            [
                'action' => 'create',
            ]
        );

        $this->addPost(
            '/register',
            [
                'action' => 'store',
            ]
        );

        $this->addGet(
            '/login',
            [
                'action' => 'create1',
            ]
        );

        $this->addPost(
            '/login',
            [
                'action' => 'store1',
            ]
        );

        $this->addGet(
            '/home',
            [
                'action' => 'home',
            ]
        );

        $this->addGet(
            '/datapasien',
            [
                'action' => 'datapasien',
            ]
        );

        $this->addPost(
            '/datapasien',
            [
                'action' => 'datapasienstore',
            ]
        );

        $this->addGet(
            '/pasienverifikasi',
            [
                'action' => 'pasienverifikasi',
            ]
        );

        $this->addPost(
            '/pasienverifikasi',
            [
                'action' => 'verifikasi',
            ]
        );

        $this->addGet(
            '/lupapassword',
            [
                'action' => 'lupapassword',
            ]
        );
        
        $this->addGet(
            '/resetpassword',
            [
                'action' => 'resetpassword',
            ]
        );
        
        $this->addPost(
            '/resetpassword',
            [
                'action' => 'resetpasswordstore',
            ]
        );
        
        $this->addPost(
            '/lupapassword',
            [
                'action' => 'lupapasswordstore',
            ]
        );

        $this->addGet(
        	'/logout',
        	[
        		'action' => 'destroy',
        	]
        );

        $this->addGet(
        	'/rekap',
        	[
        		'action' => 'rekap',
        	]
        );

        $this->addGet(
        	'/rekapdata',
        	[
        		'action' => 'rekapdata',
        	]
        );
    }
}