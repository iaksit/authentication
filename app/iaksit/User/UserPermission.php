<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 7.9.2015
 * Time: 16:05
 */

namespace iaksit\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPermission extends Eloquent
{
    protected $table = 'users_permissions';

    protected $fillable = ['is_admin'];

    public static $defaults = ['is_admin' => false];

}