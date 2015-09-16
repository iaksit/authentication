<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 18.8.2015
 * Time: 16:01
 */

namespace iaksit\Validation;

use iaksit\Helpers\Hash;
use iaksit\User\User;
use Violin\Violin;

class Validator extends Violin
{
    protected $user;
    protected $hash;
    protected $auth;

    /**
     * Validator constructor.
     */
    public function __construct(User $user, Hash $hash, $auth = null)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->auth = $auth;

        $this->addFieldMessages([
            'user_email' => [
                'uniqueEmail' => 'That email is already in use. Please try another email address.'
            ],
            'user_name' => [
                'uniqueUsername' => 'That username is already in use. Please try another username.'
            ]
        ]);

        $this->addRuleMessages([
            'matchesCurrentPassword' => 'That does not match your current password.'
        ]);
    }

    public function validate_uniqueEmail($value, $input, $args)
    {
        $user = $this->user->where('email', $value);

        if ($this->auth && $this->auth->email === $value) {
            return true;
        }

        return !(bool)$user->count();
    }

    public function validate_uniqueUsername($value, $input, $args)
    {
        return !(bool)$this->user->where('username', $value)->count();
    }

    public function validate_matchesCurrentPassword($value, $input, $args)
    {
        if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
            return true;
        }
        return false;

    }
}