<?php

namespace Router;

use App\Modules\Middleware;

/**
 * class RouterHandler
 * 
 * This class acts as a router to redirect to the actions according to the url.
 * 
 * PHP version: 8.1
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package Router
 * @license MIT
 * @version 1.0.0
 */
class RouterHandler {

    private $method;
    private $data;


    /**
     * Sets the method passed by parameters to the variable $method
     *
     * @param string $method
     * @return void
     */
    public function setMethod(string $method) : void {
        $this->method = $method;
    }

    /**
     * Sets the data passed as parameters to the variable $data
     *
     * @param array $data
     * @return void
     */
    public function setData(array $data) : void {
        $this->data = $data;
    }

    /**
     * Redirects to an action according to the passed parameters
     * 
     * The class is passed as the controller and the resource is mandatory. 
     * From there it performs actions depending on the passed method (POST, GET...).
     *
     * @param string $controller
     * @param string $resource
     * @param string $id
     * @return void
     */
    public function route(string $controller, string $resource, string $id) : void {

        Middleware::access($resource, $id);

        $resource = $controller::getInstance();

        switch($this->method) {

            case "GET":

                if ($id == "create")
                    $resource->create();
                
                else if ($id == "myevents")
                    $resource->getCreatorEvents();
       
                else if ($id == "events")
                    $resource->getAttendEvents();
                    
                else if ($id == 'show' || isset($id))
                    $resource->index();
        
                else
                    header('Location: ../404');

                break;
                    
                    
            case "POST":
                        
                if ($id == "create")
                    $resource->create();
                
                else if ($id == "store")
                    $resource->store($this->data);

                else if ($id == "edit")
                    $resource->edit($this->data['id']);
                
                else if ($id == "update")
                    $resource->update($this->data);
                
                else if ($id == "attend")
                    $resource->attend($this->data['id']);

                else
                    header('Location: ../404');

                break;

            case "delete":
                $resource->destroy($id);
                break;

        }

    }

}