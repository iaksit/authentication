<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.7.2015
 * Time: 18:56
 */


$app->get('/', function () use ($app) {
    $app->render('home.php');
})->name('home');

$app->get('/flash', function () use ($app) {
    $app->flash('global', 'You have registered!');
    return $app->response->redirect($app->urlFor('home'));
});