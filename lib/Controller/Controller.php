<?php
declare(strict_types=1);

namespace Masara\Controller;

use Masara\Error\Exception\ActionNotFoundException;
use Masara\Error\Exception\ClassNotFoundException;
use Masara\Model\Model;
use Masara\Model\SystemModel;
use Masara\View\View;

class Controller
{
    public $name = "";

    private $config;

    private $autoRender = true;

    private $view;

    public $models = [];

    public function __construct(){
        $className = get_class($this);
        $this->name = str_replace('Controller', '', str_replace('App\Controller\\', '', $className));
        if($this->models){
            foreach($this->models as $model){
                $this->getModel($model);
            }
        }
    }
    
    public function getModel($modelName){
        if(empty($modelName)){
            return null;
        }
        $realModelName = '\App\Model\\' . $modelName . 'Model';
        $libModelName = '\Masara\Model\\' . $modelName . 'Model';
        if(class_exists($realModelName)){
            $this->$modelName = new $realModelName();
        }else if(class_exists($libModelName)){
            $this->$modelName = new $libModelName();
        }else{
            throw new ClassNotFoundException();
        }
        
    }

    public function action($actionName, $param = []){
        if (method_exists($this, $actionName)) {
            $this->view = new View($this->name, $actionName);
            $this->$actionName($param);
            if($this->autoRender){
                $this->view->render();
            }
        }else{
            throw new ActionNotFoundException();
        }
    }
}