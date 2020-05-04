<?php
declare(strict_types=1);

namespace App;

use Masara\Config\Config;
use Masara\Config\Router;
use Masara\Controller\Controller;

class Application
{


    public function launch(){
        $router = new Router();
        $detectroute = $router->detect($this);
        $this->controller = new $detectroute['controller']();
        $this->controller->config = Config::loadAll();
        $this->controller->action($detectroute['action']);
    }


}