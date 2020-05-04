<?php

namespace Masara\View;

use Masara\Template\Engine;
use Masara\Error\Exception\ViewNotFoundException;

class View
{
    public $layout = 'default';

    private $layoutDir = MASARA . "/View/Layout";

    public $helper = [];

    public $templateFilePath;

    public $content;

    public function __construct($name, $template, $layout = ''){
        $this->templateFilePath = APP . '/View/' . $name . '/'.  $template . '.php';
    }


    public function render(){
        if(file_exists ($this->templateFilePath)){
            $this->content = file_get_contents($this->templateFilePath);
            include $this->layoutDir . '/'. $this->layout . '.php';
        }else{
            //throw new ViewNotFoundException();
        }
    }

}