<?php
class Bootstrap {
    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        //Check if the controller in the request is null/empty
        if($this->request['controller'] == "")
        {
            $this->controller = 'home';
        } else {
            $this->controller = $this->request['controller'];
        }

        //Check if the action in the request is null/empty
        if($this->request['action'] == "")
        {
            $this->action = 'index';
        } else {
            $this->action = $this->request['action'];
        }
    }

    public function CreateController()
    {
        //If the class of the controller exists
        if(class_exists($this->controller))
        {
            $parents = class_parents($this->controller);
            //If the controller has parents
            if(in_array("Controller", $parents)) {
                //If a method exists to execute
                if(method_exists($this->controller, $this->action))
                {
                    return new $this->controller($this->action, $this->request);
                } else {
                    //Method does not exist
                    echo '<h1>Method Does Not Exist!</h1>';
                    return;
                }
            } else {
                //Base Controller does not exist
                echo '<h1>Base controller Does Not Exist!</h1>';
                return;
            }
        } else {
            //Class Controller does not exist
            echo '<h1>Class does Not Exist!</h1>';
            return;
        }
    }
}