<?php

namespace App\Modules;

class Middleware {

    public static function access($resource, $id = '') {

        if(isset($_SESSION['id'])) {

            switch($resource) {

                case '/':
                case 'login':
                    header('refresh: 0; url = app');
                    break;

            }

        } else {

            switch($resource) {

                case 'app':
                    header('refresh: 0; url = index');
                    break;

            }

        }

    }

}