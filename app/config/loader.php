<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    [
       'App\Controllers' => $config->application->controllersDir,
       'App\Models'      => $config->application->modelsDir,
       'App\Library'      => $config->application->libraryDir,
    ]
) -> register();
