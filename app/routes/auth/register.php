<?php

use iaksit\User\UserPermission;

$app->get('/register', $guest(), function () use ($app) {
    $app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest(), function () use ($app) {
    $request = $app->request;

    $username = $request->post('user_name');
    $password = $request->post('user_password');
    $passwordConfirm = $request->post('user_password_confirm');
    $email = $request->post('user_email');
    $firstName = $request->post('user_first_name');
    $lastName = $request->post('user_last_name');
    $picture = $request->post('user_profile_picture');

    $validator = $app->validator;

    $validator->validate([
        'user_name' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
        'user_password' => [$password, 'required|min(6)'],
        'user_password_confirm' => [$passwordConfirm, 'required|matches(user_password)'],
        'user_email' => [$email, 'required|email|uniqueEmail'],
        'user_first_name' => [$firstName, 'required'],
        'user_last_name' => [$lastName, 'required']
    ]);

    if ($validator->passes()) {
        $identifier = $app->randomlib->generateString(128);

        $user = $app->user->create([
            'username' => $username,
            'password' => $app->hash->passwordGenerate($password),
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'picture' => $picture,
            'is_active' => false,
            'active_hash' => $app->hash->hashInput($identifier)
        ]);

        $user->permissions()->create(UserPermission::$defaults);

        $app->mail->send('email/auth/registered.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
            $message->to($user->email, $user->first_name . " " . $user->last_name);
            $message->subject('Thanks for registering.');
        });

        $app->flash('global', 'You have registered successfully.');
        return $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/register.php', [
        'errors' => $validator->errors(),
        'request' => $request
    ]);

})->name('register.post');