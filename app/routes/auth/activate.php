<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 28.8.2015
 * Time: 11:54
 */

$app->get('/activate', $guest(), function () use ($app) {
    $request = $app->request;

    $email = $request->get('email');
    $identifier = $request->get('identifier');
    $hashedIdentifier = $app->hash->hashInput($identifier);

    $user = $app->user
        ->where('email', $email)
        ->where('is_active', false)
        ->first();

    if (!$user || !$app->hash->hashCheck($hashedIdentifier, $user->active_hash)) {
        $app->flash('global', 'There was a problem while activating your account.');
        return $app->response->redirect($app->urlFor('home'));
    } else {
        $user->activateAccount();
        $app->flash('global', 'Your account has been activated. You can sign in now.');
        return $app->response->redirect($app->urlFor('home'));
    }
})->name('activate');