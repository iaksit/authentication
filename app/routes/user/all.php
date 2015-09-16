<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.9.2015
 * Time: 12:14
 */
$app->get('/users', function () use ($app) {

    $users = $app->user->where('is_active', true)->get();
    $app->render('user/all.php', [
        'users' => $users
    ]);

})->name('user.all');