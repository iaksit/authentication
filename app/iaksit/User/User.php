<?php

/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.7.2015
 * Time: 18:28
 */

namespace iaksit\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';

    protected $fillable = [
        //'id',
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'picture',
        'is_active',
        'active_hash',
        'recover_hash',
        'remember_identifier',
        'remember_token'
        //'created_at',
        //'updated_at'
    ];

    public function getFullNameOrUsername()
    {
        return $this->getFullName() ?: $this->username;
    }

    public function getFullName()
    {
        if (!$this->first_name || !$this->last_name) {
            return null;
        }
        return "{$this->first_name} {$this->last_name}";
    }

    public function activateAccount()
    {
        $this->update([
            'is_active' => true,
            'active_hash' => null
        ]);

    }

    public function removeRememberCredentials()
    {
        $this->updateRememberCredentials(null, null);
    }

    public function updateRememberCredentials($rememberIdentifier, $rememberToken)
    {
        $this->update([
            'remember_identifier' => $rememberIdentifier,
            'remember_token' => $rememberToken
        ]);
    }

    public function getAvatarUrl($options = [])
    {
        $size = (isset($options['size'])) ? (int)$options['size'] : 64;
        $forcedefault = (isset($options['f'])) ? $options['f'] : 'y';
        $defaultAvatar = (isset($options['d'])) ? $options['d'] : 'identicon';
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&f=' . $forcedefault . '&d=' . $defaultAvatar;
    }

    public function hasPermission($permission)
    {
        return (bool)$this->permissions->{$permission};
    }

    public function isAdmin()
    {
        return $this->hasPermission('is_admin');
    }

    public function permissions()
    {
        return $this->hasOne('iaksit\User\UserPermission', 'user_id');
    }
}