<?php

use Phalcon\Config;

return new Config([

    'database' => [
        'adapter' => 'Phalcon\Db\Adapter\Pdo\Mysql',
        'host' => '127.0.0.1',
        'username' => 'rzndwbco_rizan',
        'password' => 'aplikasiwebku',
        'dbname' => 'rzndwbco_medlog'
    ],
    'url' => [
        'baseUrl' => 'https://rzndwb.com/'
    ]
]);