<?php

class Route
{
    public function __construct()
    {
        $url = $this->url();
        $this->prx($url);
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