<?php

namespace Helpers;

use Model\ActiveRecord;

class Auth extends ActiveRecord
{
    protected static $tabla = 'users';

    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }
   
    public static function attempt($args = [])
    {
        $email = $args['email'];
        $user = self::where('email', $email);
        if (!$user) return false;

        if (Hash::check($args['password'], $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}
