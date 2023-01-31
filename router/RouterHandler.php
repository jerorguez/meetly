<?php

namespace Router;

use App\Modules\Middleware;

class RouterHandler {

    private $method;
    private $data;


    public function setMethod($method) {
        $this->method = $method;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function route($controller, $resource, $id) {

        Middleware::access($resource, $id);

        $resource = $controller::getInstance();

        switch($this->method) {

            case "GET":

                if ($id == "create")
                    $resource->create();
                
                else if ($id == "myevents")
                    $resource->getCreatorEvents();
                    
                    else
                    $resource->index();
                    
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
                    header('Location: 404');

                break;

            case "delete":
                $resource->destroy($id);
                break;

        }

    }

}