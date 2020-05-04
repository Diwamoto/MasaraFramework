<?php

namespace Masara\Config;

class Router
{

    public $routes;

    public $detectroute;


    public function route($uri, $options){
        $this->routes[$uri] = $options;
    }


    public function detect(){
        require ROOT . '/app/config/routes.php';
        $uri = $_SERVER['REQUEST_URI'];
        $key = array_search($uri, array_keys($this->routes));
        if(isset($key)){
            $this->detectroute = $this->routes[$uri];
            $this->detectroute['controller'] = '\App\Controller\\' . $this->detectroute['controller'] . 'Controller';
            return $this->detectroute;
        }
    }
}