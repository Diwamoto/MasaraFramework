<?php

namespace Masara\Template;

class Engine
{

    public function build($view){
        include $view->layout;
    }
}