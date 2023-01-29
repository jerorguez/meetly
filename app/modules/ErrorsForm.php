<?php

namespace App\Modules;

use App\Modules\ValidationForm;
use App\Controllers\UserController;

class ErrorsForm {

    public static function userForm() {

        if (ValidationForm::checkEmptyPost(['surname_2'])) {
            return "Rellena los campos son obligatorios";
        
        } else if (!ValidationForm::checkString([
                $_POST['name'], 
                $_POST['surname_1'],
                $_POST['surname_2'],
            ])) {

                return "El Nombre o Apellido no es válido.";
        
        } else if (!ValidationForm::checkEmail()) {
            
            return "El email no es válido. Ej: email@email.com";

        } else if (!ValidationForm::checkConfirmPasswords()) {
            
            return "Las contraseñas no coinciden.";

        } else if (UserController::getInstance()->checkEmailExist($_POST['email'])) {

            return "El email ya está registrado.";

        }

    }

}