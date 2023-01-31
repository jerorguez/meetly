<?php

namespace App\Modules;

class Middleware {

    public static function access($resource, $id = '') {

        if(isset($_SESSION['id'])) {

            switch($resource) {

                case '/':
                case 'login':
                case 'event' && (empty($id)):
                    header('Location: event/show');
                    break;

                case 'user':
                    if ($id === 'create')
                        header('Location: ../event/show');
                    break;

            }

        } else {

            switch($resource) {

                case 'app':
                case 'event':
                    header('Location: index');
                    break;

                case 'user':
                    if ($id !== 'create')
                        header('Location: index');
                    break;

            }

        }

    }

}