<?php

namespace Masara\DataBase;

use Masara\Config\Config;

class Connection
{

    private $dbConfig;
    
    private $connection;

    public function __construct()
    {
        $dbConfig = Config::get('database');
        $this->dbConfig = $dbConfig;
        $this->connectDB();
    }

    public function connectDB(){
        try{
            $pdo = $this->dbConfig['engine'] . ':host=' . $this->dbConfig['host'] . ';dbname=' . $this->dbConfig['db']; 
            $this->connection = new \PDO($pdo, $this->dbConfig['user'], $this->dbConfig['password'], array(\PDO::ATTR_EMULATE_PREPARES => false));
        } catch(\PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
    
    public function execQuery($queryString){
        $result = $this->connection->query($queryString);
        if($result){
            return $result->fetchAll();
        }else{
            var_dump($queryString);
        }
    }
}