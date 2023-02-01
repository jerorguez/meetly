<?php

namespace App\Modules;

/**
 * class Modules
 * 
 * This class packages generic modules.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Modules
 * @license MIT
 * @version 1.0.0
 */
class Modules {

    /**
     * Create a hash of the password
     *
     * @param string $password
     * @return string
     */
    public static function hashPasswd(string $password) : string {

        $options = [ 'cost' => 12 ];

        return password_hash($password, PASSWORD_DEFAULT, $options);

    }

}