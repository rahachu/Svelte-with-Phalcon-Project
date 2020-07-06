<?php
declare(strict_types=1);

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Dispatcher;

try {
    require_once BASE_PATH . '/vendor/autoload.php';

    /**
     * Load .env configurations
     */
    Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH)->load();


    /**
         * The FactoryDefault Dependency Injector automatically registers
         * the services that provide a full stack framework.
         */
        $di = new FactoryDefault();

        /**
         * Read services
         */
        include APP_PATH . '/config/services.php';

        /**
         * Handle routes
         */
        include APP_PATH . '/config/router.php';

        /**
         * Get config service for use in inline setup below
         */
        $config = $di->getConfig();

        /**
         * Include Autoloader
         */
        include APP_PATH . '/config/loader.php';

        /**
         * Init namespace
         */
        $di->set(
        'dispatcher',
            function () {
                $dispatcher = new Dispatcher();

                $dispatcher->setDefaultNamespace(
                    'App\Controllers'
                );

                return $dispatcher;
            }
        );

        /**
         * Handle the request
         */
        echo (new Application($di))->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
