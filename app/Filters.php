<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 28.8.2015
 * Time: 15:48
 */

/**
 * @param $required
 * @return Closure
 */

$authenticationCheck = function ($required) use ($app) {
    return function () use ($required, $app) {
        if ((!$app->auth && $required) || ($app->auth && !$required)) {
            $app->redirect($app->urlFor('home'));
        }
    };
};

$authenticated = function () use ($authenticationCheck) {
    return $authenticationCheck(true);
};

$guest = function () use ($authenticationCheck) {
    return $authenticationCheck(false);
};

$admin = function () use ($app) {
    return function () use ($app) {
        if (!$app->auth || !$app->auth->isAdmin()) {
            $app->redirect($app->urlFor('home'));
        }
    };
};