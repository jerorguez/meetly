<?php

namespace App\Controllers;

use App\Controllers\UserController;

class LoginController {

    public static function login() {

        if($_POST) {

            $user = UserController::getInstance()->checkByEmail($_POST['email']);
    
            if (password_verify($_POST['password'], $user['password'])) {
                
                // Code...

            } else {
                $errorMsg = "Comprueba el email o contraseña";
            }

        }
        

        require_once('../views/login.php');
    }

    public static function logout() {}

}