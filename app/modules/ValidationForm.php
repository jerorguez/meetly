<?php

namespace App\Modules;

/**
 * class ValidationForm
 * 
 * This class contains the different filters for validations.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Modules
 * @license MIT
 * @version 1.0.0
 */
class ValidationForm {

    /**
     * Validation regex for names and strings
     *
     * @var string
     */
    private static $regexString = "/^[a-zA-ZÀ-ÿ\s']*$/";
 
    /**
     * Verify empty fields
     * 
     * Checks the data sent through post and returns true if it contains 
     * empty data. Additionally you can pass an array with the field name 
     * to exclude it from validation.
     *
     * @param array $exceptions
     * @return void
     */
     public static function checkEmptyPost(array $exceptions = []) {

         foreach ($_POST as $entry => $value) {
            if (empty($value) && !in_array($entry, $exceptions)) 
                return true;
         }
 
     }
 
     /**
      * Filter to verify emails
      *
      * @return boolean
      */
     public static function checkEmail() : bool {
         return filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
     }
 
     /**
      * Filter to check string through regex $regexString
      *
      * Receives an array by parameter with the POST value and returns false 
      * in case of finding strange characters ($regexString).
      * 
      * @param array $entries
      * @return boolean
      */
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

     /**
      * Verify password confirmation
      *
      * @return boolean
      */
     public static function checkConfirmPasswords() : bool {
        return $_POST['password'] === $_POST['password_check'];
     }

 }