<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 28.8.2015
 * Time: 11:54
 */

$app->get('/change-password', $authenticated(), function () use ($app) {
    $app->render('auth/password/change.php');
})->name('auth.password.change');


$app->post('/change-password', $authenticated(), function () use ($app) {

    $request = $app->request;

    $oldPassword = $request->post('old_user_password');
    $newPassword = $request->post('new_user_password');
    $confirmNewPassword = $request->post('new_user_password_confirm');

    $validator = $app->validator;
    $validator->validate([
        'old_user_password' => [$oldPassword, 'required|matchesCurrentPassword'],
        'new_user_password' => [$newPassword, 'required|min(6)'],
        'new_user_password_confirm' => [$confirmNewPassword, 'required|matches(new_user_password)']
    ]);

    if ($validator->passes()) {
        $user = $app->auth;

        $user->update([
            'password' => $app->hash->passwordGenerate($newPassword)
        ]);

        //Send Email
        $app->mail->send('email/auth/password/changed.php', [], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('You have changed your password.');
        });

        $app->flash('global', 'You have changed your password.');
        return $app->response->redirect($app->urlFor('home'));

    }

    $app->render('auth/password/change.php', [
        'errors' => $validator->errors(),
        'request' => $request
    ]);

})->name('auth.password.change.post');