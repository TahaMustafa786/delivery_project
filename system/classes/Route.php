<?php

class Route
{
    public $controller =  "Home";
    public $method = "index";
    public $params = [];

    public function __construct()
    {
        $url = $this->url();
        if (!empty($url)) {
            if (file_exists("../application/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                die("Contoller Not Found");
            }
            require_once("../application/controllers/" . $this->controller . ".php");
            $this->controller = new $this->controller();
            if(isset($url[1]) && !empty($url[1])) {
                if (method_exists($this->controller, $this->method)) {  
                    $this->method = $url[1];
                    unset($url[1]);
                } else {
                    die("Method Not Found");
                }
            }
            if(isset($url)) {
                $this->params = $url;
                // $this->prx($this->params);
            } else {
                $this->params = [];
            }
            call_user_func_array([$this->controller, $this->method], $this->params);

        }
    }

    public function prx($arr) {
        echo "<pre>";
        print_r($arr);
        die();
    }

    public function pr($arr) {
        echo "<pre>";
        print_r($arr);
    }

    public function url () {
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
            $url = rtrim($url); 
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }


}