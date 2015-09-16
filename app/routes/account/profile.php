<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 10.9.2015
 * Time: 15:35
 */

$app->get('/account/profile', $authenticated(), function () use ($app) {
    $app->render('account/profile.php');
})->name('account.profile');

$app->post('/account/profile', $authenticated(), function () use ($app) {
    $request = $app->request;

    $email = $request->post('user_email');
    $firstName = $request->post('user_first_name');
    $lastName = $request->post('user_last_name');
    $picture = $request->post('user_profile_picture');

    $validator = $app->validator;
    $validator->validate([
        'user_email' => [$email, 'required|email|uniqueEmail'],
        'user_first_name' => [$firstName, 'required|alpha|max(50)'],
        'user_last_name' => [$lastName, 'required|alpha|max(50)']
    ]);

    if ($validator->passes()) {
        $identifier = $app->randomlib->generateString(128);

        $app->auth->update([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'picture' => $picture
        ]);

        $app->flash('global', 'Your profile details has been updated successfully.');
        return $app->response->redirect($app->urlFor('account.profile'));
    }

    $app->render('account/profile.php', [
        'errors' => $validator->errors(),
        'request' => $request
    ]);

})->name('account.profile.post');