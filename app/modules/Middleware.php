<?php

namespace App\Modules;

/**
 * class Middleware
 * 
 * This class presents static methods to control access to 
 * pages depending on whether the user is logged in or not.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Modules
 * @license MIT
 * @version 1.0.0
 */
class Middleware {

    /**
     * Controls access to routes
     *
     * Controls access to certain pages depending on whether the 
     * user is logged in or not.
     * 
     * @param class $resource
     * @param string $id
     * @return void
     */
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