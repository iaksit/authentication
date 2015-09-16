<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 28.8.2015
 * Time: 11:54
 */

$app->get('/recover-password', $guest(), function () use ($app) {
    $app->render('auth/password/recover.php');
})->name('auth.password.recover');


$app->post('/recover-password', $guest(), function () use ($app) {

    $request = $app->request;

    $email = $request->post('user_email');

    $validator = $app->validator;
    $validator->validate([
        'email' => [$email, 'required|email']
    ]);

    if ($validator->passes()) {
        //$user = $app->auth;

        $user = $app->user
            ->where('email', $email)
            ->first();

        if ($user) {
            $identifier = $app->randomlib->generateString(128);

            $user->update([
                'recover_hash' => $app->hash->hashInput($identifier)
            ]);

            //Send Email
            $app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Recover your password.');
            });

            $app->flash('global', 'We have emailed you the instructions to reset your password.');
            return $app->response->redirect($app->urlFor('home'));
        } else {
            $app->flash('global', 'Could not found that user.');
            return $app->response->redirect($app->urlFor('auth.password.recover'));
        }

    }

    $app->render('auth/password/recover.php', [
        'errors' => $validator->errors(),
        'request' => $request
    ]);
})->name('auth.password.recover.post');