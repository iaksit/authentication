<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 4.9.2015
 * Time: 17:08
 */

$app->get('/user/:username', function ($username) use ($app) {
    $user = $app->user->where('username', (string)$username)->first();

    if (!$user) {
        $app->notFound();
    }

    $app->render('user/profile.php', [
        'user' => $user
    ]);

})->name('user.profile');