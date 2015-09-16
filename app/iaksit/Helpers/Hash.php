<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 18.8.2015
 * Time: 13:43
 */

namespace iaksit\Helpers;

class Hash
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function passwordGenerate($password)
    {
        return password_hash(
            $password,
            $this->config->get('app.hash.algo'),
            ['cost' => $this->config->get('app.hash.cost')]
        );
    }

    public function passwordCheck($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function hashInput($input)
    {
        return hash('sha256', $input);
    }

    public function hashCheck($know, $user)
    {
        return hash_equals($know, $user);
    }

}