<?php

namespace App\Modules;

class Modules {

    public static function hashPasswd(string $password) : string {

        $options = [ 'cost' => 12 ];

        return password_hash($password, PASSWORD_DEFAULT, $options);

    }

}