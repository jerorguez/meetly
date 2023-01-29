<?php

namespace Router;

class RouterHandler {

    private $method;
    private $data;


    public function setMethod($method) {
        $this->method = $method;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function route($controller, $id) {

        $resource = $controller::getInstance();

        switch($this->method) {

            case "GET":

                if ($id && $id == "create")
                    $resource->create();
                
                else if ($id) 
                    $resource->show($id);

                else
                    $resource->index();

                break;

            
            case "POST":
                $resource->create();
                break;

            case "delete":
                $resource->destroy($id);

        }

    }

}