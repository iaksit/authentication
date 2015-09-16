<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.7.2015
 * Time: 17:51
 */

return [
    //App Setting
    'app' => [
        'url' => 'http://authentication.local',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        ]
    ],

    //Database Setting
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'name' => 'site_db',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ],

    //Auth Setting
    'auth' => [
        'session' => 'user_id',
        'remember' => 'user_rem'
    ],

    //Mail Setting
    'mail' => [
        'smtp_auth' => true,
        'smtp_secure' => 'tls',
        'host' => 'smtp.gmail.com',
        'username' => 'demo@gmail.com',
        'password' => 'demo123.',
        'port' => 587,
        'html' => true
    ],

    //Twig Setting
    'twig' => [
        'debug' => true
    ],

    //Csrf Setting
    'csrf' => [
        'key' => 'app_csrf_token'
    ]

];