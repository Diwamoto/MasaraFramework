<?php

namespace Masara\View\Helper;

use Masara\View\Helper\Helper;

class HtmlHelper extends Helper
{
    public function css($name){
        if(strpos($name,'.css') === false){
            $name = $name . '.css';
        }
        echo '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . $name . '">';
    }

    public function js($name){
        if(strpos($name,'.js') === false){
            $name = $name . '.js';
        }
        echo '<script src=\"' . $name . '\"></script>';

    }

    public function img($name){
        echo '<img src=\"' . $name . '\">';
    }
}