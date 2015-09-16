<?php
use Carbon\Carbon;

$app->get('/login', $guest(), function () use ($app) {
    $app->render('auth/login.php');
})->name('login');

$app->post('/login', $guest(), function () use ($app) {
    $request = $app->request;

    $identifier = $request->post('user_identifier');
    $password = $request->post('user_password');
    $remember = $request->post('remember');

    $validator = $app->validator;

    $validator->validate([
        'user_identifier' => [$identifier, 'required'],
        'user_password' => [$password, 'required|min(6)']
    ]);

    if ($validator->passes()) {
        $user = $app->user
            ->where('is_active', true)
            ->where(function ($query) use ($identifier) {
                return $query->where('email', $identifier)
                    ->orWhere('username', $identifier);
            })
            ->first();

        if ($user && $app->hash->passwordCheck($password, $user->password)) {
            $_SESSION[$app->config->get('auth.session')] = $user->id;

            if ($remember === 'on') {
                $rememberIdentifier = $app->randomlib->generateString(128);
                $rememberToken = $app->randomlib->generateString(128);

                $user->updateRememberCredentials(
                    $rememberIdentifier,
                    $app->hash->hashInput($rememberToken)
                );

                $app->setCookie(
                    $app->config->get('auth.remember'),
                    "{$rememberIdentifier}__ia__{$rememberToken}",
                    Carbon::parse('+1 week')->timestamp
                );

            }
            $app->flash('global', 'You have signed in successfully.');
            return $app->response->redirect($app->urlFor('home'));
        } else {
            $app->flash('global', 'You could not login in the system!');
            return $app->response->redirect($app->urlFor('login'));
        }

    }

    $app->render('auth/login.php', [
        'errors' => $validator->errors(),
        'request' => $request
    ]);

})->name('login.post');

