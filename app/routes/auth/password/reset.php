<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 28.8.2015
 * Time: 11:54
 */

$app->get('/password-reset', $guest(), function () use ($app) {

    $request = $app->request;

    $email = $request->get('email');
    $identifier = $request->get('identifier');
    $hashedIdentifier = $app->hash->hashInput($identifier);

    $user = $app->user->where('email', $email)->first();

    if (!$user) {
        return $app->response->redirect($app->urlFor('home'));
    }

    if (!$user->recover_hash) {
        return $app->response->redirect($app->urlFor('home'));
    }

    if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
        return $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/reset.php', [
        'email' => $user->email,
        'identifier' => $identifier
    ]);
})->name('auth.password.reset');


$app->post('/password-reset', $guest(), function () use ($app) {

    $request = $app->request;

    $newPassword = $request->post('new_user_password');
    $confirmNewPassword = $request->post('new_user_password_confirm');

    $email = $request->get('email');
    $identifier = $request->get('identifier');
    $hashedIdentifier = $app->hash->hashInput($identifier);

    $user = $app->user->where('email', $email)->first();

    if (!$user) {
        return $app->response->redirect($app->urlFor('home'));
    }

    if (!$user->recover_hash) {
        return $app->response->redirect($app->urlFor('home'));
    }

    if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
        return $app->response->redirect($app->urlFor('home'));
    }

    $validator = $app->validator;
    $validator->validate([
        'new_user_password' => [$newPassword, 'required|min(6)'],
        'new_user_password_confirm' => [$confirmNewPassword, 'required|matches(new_user_password)']
    ]);

    if ($validator->passes()) {

        $user->update([
            'password' => $app->hash->passwordGenerate($newPassword),
            'recover_hash' => null
        ]);

        //Send Email
        $app->mail->send('email/auth/password/changed.php', [], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('You have changed your password.');
        });

        $app->flash('global', 'Your password has been reset and you can now sign in.');
        return $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/reset.php', [
        'errors' => $validator->errors(),
        'email' => $user->email,
        'identifier' => $identifier,
        'request' => $request
    ]);
})->name('auth.password.reset.post');