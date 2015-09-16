<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 9.9.2015
 * Time: 11:43
 */

$app->notFound(function () use ($app) {
    $app->render('errors/404.php');
});