<?php

namespace App\Modules;

class ValidationForm {

    private static $regexString = "/^[a-zA-ZÀ-ÿ\s']*$/";
 
     public static function checkEmptyPost(array $exceptions = []) {

         foreach ($_POST as $entry => $value) {
            if (empty($value) && !in_array($entry, $exceptions)) 
                return true;
         }
 
     }
 
     public static function checkEmail() : bool {
         return filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
     }
 
     public static function checkString(array $entries) : bool {

        $is_valid = true;

        foreach ($entries as $entry) {

            if (!empty($entry)) {
                
                if(!filter_var($entry, FILTER_VALIDATE_REGEXP, array(
                    "options" => array("regexp" => self::$regexString)
                ))) {
                    $is_valid = false;
                };

            }
        }

        return $is_valid;

     }

     public static function checkConfirmPasswords() : bool {
        return $_POST['password'] === $_POST['password_check'];
     }

 }