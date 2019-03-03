<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class DokterRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'dokter',
        ]);
        
        $this->setPrefix('/dokter');

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
            '/datadokter',
            [
                'action' => 'datadokter',
            ]
        );

        $this->addPost(
            '/datadokter',
            [
                'action' => 'datadokterstore',
            ]
        );

        $this->addGet(
            '/lihatpasien',
            [
                'action' => 'lihatpasien',
            ]
        );

        $this->addGet(
            '/lihatpasiendata',
            [
                'action' => 'lihatpasiendata',
            ]
        );

        $this->addGet(
            '/tambahpasien',
            [
                'action' => 'tambahpasien',
            ]
        );

        $this->addPost(
            '/tambahpasien',
            [
                'action' => 'tambahpasienstore',
            ]
        );

			$this->addGet(
				'/detailpasien/{idp}',
				[
					'action' => 'detailpasien',
				]
            );
            
            $this->addGet(
				'/detailpasiendata/{idp}',
				[
					'action' => 'detailpasiendata',
				]
			);

			$this->addGet(
				'/detailpasien/{idp}/periksa',
				[
					'action' => 'periksa',
				]
            );
            
            $this->addGet(
				'/rekammedis/{idp}',
				[
					'action' => 'rekammedis',
				]
			);

			$this->addPost(
				'/storeperiksa',
				[
					'action' => 'storeperiksa',
				]
            );
            
            $this->addGet(
				'/hapuspasien/{idp}',
				[
					'action' => 'hapuspasien',
				]
            );
            
            $this->addGet(
				'/rekammedis/download/{idp}',
				[
					'action' => 'download',
				]
			);

            $this->addGet(
				'/tampil/{idp}',
				[
					'action' => 'tampil',
				]
            );
            
            $this->addGet(
				'/dokterverifikasi',
				[
					'action' => 'dokterverifikasi',
				]
            );

            $this->addPost(
				'/dokterverifikasi',
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
		}
	}
