<?php
declare(strict_types=1);

namespace Masara\Model;

use Masara\DataBase\QueryBuilder;
use Masara\Error\Exception\QuerySyntaxErrorException;

class Model
{
    public $table;

    public $columns;

    public $dbConfig;

    public $limit = 50;

    public function __construct(){
        $className = get_class($this);
        $this->table = str_replace('Model', '', str_replace('App\model\\', '',str_replace('Masara\Model\\', '', $className)));
        $query = new QueryBuilder();
        $this->columns = $query->init($this->table);
    }

    public function add($order) {
        $query = new QueryBuilder();
        $result = $query->insert($this->table, $this->columns)->values($order)->execute();
        if($result){
            return $result;
        }else{
            //追加対象無し時の処理
        }
    }

    public function get($order, $where = []) {
        $query = new QueryBuilder();
        $query->select($order, $this->table);
        if(!empty($where)) {
            if(count($order) == count($where)){
                $query->where($order, $where);
            }else{
                throw new QuerySyntaxErrorException();
            }
        }
        return $query->limit($this->limit)->execute();
    }

    public function update($where, $order) {
        $query = new QueryBuilder();
        $orders = [];
        $conditions = [];
        foreach($where as $key => $val){
            $orders[] = $key;
            $conditions['='] = $val;
        }
        $result = $query->update($this->table, $order)->where($orders, $conditions)->execute();
        if($result){
            return $result;
        }else{
            //更新対象無し時の処理
        }
    }

    public function delete($target){
        $query = new QueryBuilder();
        $orders = [];
        $conditions = [];
        $query->delete($this->table);
        foreach($target as $key => $val){
            $orders[] = $key;
            $conditions['='] = $val;
        }
        $result = $query->where($orders, $conditions)->execute();
        if($result){
            return $result;
        }else{
            //削除対象無し時の処理
        }
    }

    public function query($queryString){
        $query = new QueryBuilder();
        $query->row($queryString)->execute();
    }
}