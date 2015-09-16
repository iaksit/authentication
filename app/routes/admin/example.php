<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.9.2015
 * Time: 16:19
 */

$app->get('/admin/example', $admin(), function () use ($app) {
    $app->render('admin/example.php');
})->name('admin.example');