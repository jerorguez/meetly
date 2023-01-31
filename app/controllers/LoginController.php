<?php

namespace App\Controllers;

use App\Controllers\UserController;

class LoginController {

    public static function login() {

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

    public static function checkSecurity() {

        $user = UserController::getInstance()->checkByEmail($_POST['email']);

        if ($_SESSION['id'] !== $user['user_id']) {
            self::logout();
        }

    }

    public static function logout() {
        session_destroy();
        header('Location: index');
    }

}