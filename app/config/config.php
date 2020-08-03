<?php

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'    => "Mysql",#getenv('DB_ADAPTER'),
        'host'       => "127.0.0.1", #getenv('DB_HOST'),
        'username'   => "root",#getenv('DB_USERNAME'),
        'password'   => "",#getenv('DB_PASSWORD'),
        'dbname'     => "pateron",#getenv('DB_NAME'),
        'charset'    => 'utf8',
    ],

    'application' => [
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'libraryDir'     => APP_PATH . '/library/',
        'controllersDir' => APP_PATH . '/Controllers',
        'baseUri'        => '/',
        'publicUrl'      => getenv('APP_PUBLIC_URL')
    ],

    'mail'        => [
        'fromName'  => getenv('MAIL_FROM_NAME'),
        'fromEmail' => getenv('MAIL_FROM_EMAIL'),
        'smtp'      => [
            'server'   => getenv('MAIL_SMTP_SERVER'),
            'port'     => getenv('MAIL_SMTP_PORT'),
            'security' => getenv('MAIL_SMTP_SECURITY'),
            'username' => getenv('MAIL_SMTP_USERNAME'),
            'password' => getenv('MAIL_SMTP_PASSWORD'),
        ],
    ],
    'secureCsrf' => (getenv('CSRF_SECURE')=='true')
]);
