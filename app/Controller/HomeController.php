<?php

namespace App\Controller;

use Masara\Controller\Controller;

class HomeController extends Controller
{

    public $models = ['City'];


    public function display(){
        // $all = $this->City->get(
        //     [
        //         '*'
        //     ]));
        // $this->City->add([
        //     'test',
        //     'TES',
        //     'testes',
        //     12000
        // ]);
        // $this->City->update(
        //     [
        //         'ID' => '4084',
        //     ],
        //     [
        //         'Name' => 'Updated'
        //     ]
        // );
        // $this->City->delete([
        //     'ID' => '4080'
        // ]);
    }
}