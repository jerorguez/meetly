<?php

namespace App\Controllers;

use App\Controllers\UserController;

/**
 * class LoginController
 * 
 * This class contains methods related to user login.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Controllers
 * @license MIT
 * @version 1.0.0
 */
class LoginController {

    /**
     * Method for user login
     * 
     * When filling in the fields of the login form, check if the email 
     * address exists and if the password provided corresponds to the 
     * email address. Once verified, it creates a session with the data 
     * entered.
     *
     * @return void
     */
    public static function login() : void {

        if($_POST) {

            if (UserController::getInstance()->checkEmailExist($_POST['email'])) {
                
                $user = UserController::getInstance()->checkByEmail($_POST['email']);
        
                if (password_verify($_POST['password'], $user['password'])) {
                    
                    $_SESSION['id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = "{$user['name']} {$user['surname_1']}";

                    header('refresh: 0; url = login');
                    header('Location: index');
    
                } else {
                    $errorMsg = "Contraseña incorrecta";
                }

            } else {
                    $errorMsg = "Email no encontrado";
            }

        }
        

        require_once('../views/login.php');
    }

    /**
     * Method for verifying session integrity
     * 
     * This method implements a small security feature that verifies at all times if 
     * he user id corresponds to the stored email, so if any of the two data are changed, 
     * the user will be logged out.
     *
     * @return void
     */
    public static function checkSecurity() : void {

        $user = UserController::getInstance()->checkByEmail($_POST['email']);

        if ($_SESSION['id'] !== $user['user_id']) {
            self::logout();
        }

    }

    /**
     * Method for user logout
     * 
     * Calling this method deletes the created session, 
     * so the user is logged out.
     *
     * @return void
     */
    public static function logout() : void {
        session_destroy();
        header('Location: index');
    }

}