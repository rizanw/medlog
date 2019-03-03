<?php

/*
 * Fungsi pemanggilan Volt service
 */
$di->set(
    'voltService',
    function ($view, $di) {
        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions([
            "compiledPath" => APP_PATH . "/cache/",
            "compiledExtension" => ".compiled",
            "compileAlways" => true,
        ]);

        return $volt;
    }
);

/*
 * Fungsi pemanggilan view
 */
$di->set(
    'view',
    function () {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir(APP_PATH . "/views");
        // echo APP_PATH."\\views";

        $view->registerEngines([
            ".volt" => "voltService",
        ]);

        return $view;

    }
);

/*
 * Fungsi koneksi database
 */
$di->set(
    'db',
    function () use ($config) {
        $dbAdapter = $config->database->adapter;
        return new $dbAdapter([
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname
        ]);
    }
);

/*
 * Fungsi URL service
 */
$di->set(
    'url',
    function () use ($config, $di) {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri($config->path('url.baseUrl'));

        return $url;
    }
);

/*
 * Fungsi session service
 */
$di->set(
    'session',
    function () {
        $session = new Phalcon\Session\Adapter\Files();

        $session->start();

        return $session;
    }
);