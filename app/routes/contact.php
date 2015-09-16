<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.7.2015
 * Time: 18:56
 */


$app->get('/contact', function () use ($app) {
    $app->render('contact.php');
})->name('contact');