<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.7.2015
 * Time: 17:28
 */

use iaksit\Helpers\Hash;
use iaksit\Mail\Mailer;
use iaksit\Middleware\BeforeMiddleware;
use iaksit\Middleware\CsrfMiddleware;
use iaksit\User\User;
use iaksit\Validation\Validator;
use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;


define('APP_ENV_DEV', 'development');
define('APP_ENV_PRODUCTION', 'production');

if (!defined('APP_ENV')) {
    define('APP_ENV', (getenv('APP_ENV')) ? getenv('APP_ENV') : APP_ENV_DEV);
}

define('INC_ROOT', dirname(__DIR__));

session_cache_limiter(false);
session_start();

if (APP_ENV == APP_ENV_DEV) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
    //'mode' => file_get_contents(INC_ROOT . '/mode.php'),
    'mode' => APP_ENV,
    'view' => new Twig(),
    'templates.path' => INC_ROOT . '/app/views'
]);

$app->add(new BeforeMiddleware());
$app->add(new CsrfMiddleware());

$app->configureMode($app->config('mode'), function () use ($app) {
    $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'Database.php';
require 'Filters.php';
require 'Routes.php';

$app->auth = false;

$app->container->set('user', function () {
    return new User;
});

$app->container->singleton('hash', function () use ($app) {
    return new Hash($app->config);
});

$app->container->singleton('validator', function () use ($app) {
    return new Validator($app->user, $app->hash, $app->auth);
});


$app->container->singleton('mail', function () use ($app) {
    $mailer = new PHPMailer;
    $mailer->Host = $app->config->get('mail.host');
    $mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
    $mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
    $mailer->Port = $app->config->get('mail.port');
    $mailer->Username = $app->config->get('mail.username');
    $mailer->Password = $app->config->get('mail.password');
    $mailer->isHTML($app->config->get('mail.html'));
    //Return mailer object
    return new Mailer($app->view, $mailer);
});

$app->container->singleton('randomlib', function () use ($app) {
    $factory = new RandomLib;
    return $factory->getMediumStrengthGenerator();
});

$view = $app->view();

$view->parserOptions = [
    'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
    new TwigExtension()
];