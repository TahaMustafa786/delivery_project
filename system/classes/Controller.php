<?php

class Controller
{

    public function view($viewName, $data = [])
    {
        if (file_exists("../application/views/" . $viewName . ".php")) {
            require_once("../application/views/" . $viewName . ".php");
        } else {
            die("view not found");
        }
    }

    public function model($modelName, $data = [])
    {
        if (file_exists("../application/models/" . $modelName . ".php")) {
            require_once("../application/models/" . $modelName . ".php");
            return new $modelName;
        } else {
            die("modal not found");
        }
    }
}
