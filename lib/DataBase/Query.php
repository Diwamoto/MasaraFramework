<?php

namespace Masara\DataBase;

use Masara\DataBase\Connection;

class Query
{
    private $queryString = "";
    
    private $connection;
    
    public function __construct(){
        $this->connection = new Connection();
    }

    public function init($table){
        return $this->connection->execQuery('DESC '. strtolower($table));
    }

    public function append($queryString) {
        $this->queryString = $this->queryString . $queryString;
        return $this;
    }

    public function destroy() {
        $this->queryString = "";
        return $this;
    }

    public function execute() {
        $result = $this->connection->execQuery($this->queryString . ';');
        $this->destroy();
        return $result;
    }

    public function publish() {
        return $this->queryString;
    }

}