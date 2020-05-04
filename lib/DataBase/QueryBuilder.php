<?php

namespace Masara\DataBase;

use Masara\DataBase\Query;

final class QueryBuilder extends Query
{

    public function insert($table, $columns){
        $this->append('INSERT INTO `' . strtolower($table) . '` ( ');
        $counter = 0;
        foreach($columns as $col){
            $colName = $col['Field'];
            if($colName == 'ID' || $colName == 'Id' || $colName == 'id'){
                $counter++;
                continue;
            }
            $this->append('`' . $colName . '`');
            if($counter < count($columns) - 1){
                $this->append(', ');
                $counter++;
            }
        }
        return  $this->append(') ');
    }

    public function values($value){
        $this->append('VALUES (');
        $counter = 0;
        foreach($value as $val){
            $this->append('"' . $val . '"');
            if($counter < count($value) - 1){
                $this->append(', ');
                $counter++;
            }
        }
        return $this->append(') ');
    }

    public function select($request, $table){
        $this->append('SELECT ');
        if(is_array($request) && count($request) === 2){
            $this->append('(');
        }
        $counter = 0;
        foreach($request as $val){
            if($request == '*'){
                $this->append('* ');
            }else{
                $this->append('`' . h($val) . '`');
                if($counter < count($request) - 1){
                    $this->append(',');
                    $counter++;
                }
            }
        }
        if(is_array($request) && count($request) === 2){
            $this->append(')');
        }
        return $this->append('FROM `' . toSnake(h($table)) . '` ');
    }

    public function update($table, $order){
        $this->append('UPDATE `' . $table . '` SET ');
        $counter = 0;
        foreach($order as $key => $val){
            $this->append($key . ' = "' . $val . '"');
            if($counter < count($order) - 1){
                $this->append(', ');
                $counter++;
            }
        }
        return $this->append(' ');
    }

    public function where($order, $condition){
        $this->append('WHERE ');
        $counter = 0;
        foreach($condition as $operator => $value){
            switch($operator){
                case '>':
                case '=':
                case '<':
                case '<=':
                case '>=':
                    $this->append('`' . h($order[$counter]) . '` ' . $operator . ' ' . h($value));
                    break;
                case 'LIKE':
                    $this->append('`' . h($order[$counter]) . '` ' . $operator . ' "%' . h($value) . '%"');
                    break;
                case 'IN':
                    $rangeString = str_replace('~', ',', str_replace('-', ',', str_replace(' ', ',', h($value))));
                    $range = explode(',', $rangeString);
                    if(is_array($range) && count($range) === 2){
                        $this->append('`' . h($order[$counter]) . '` ' . $operator . ' (' . h($range[0]) . ',' . h($range[1]) . ')');
                    }
                    break;
                case 'IS NULL':
                    $this->append('`' . h($order[$counter]) . '` ' . $operator);
                    break;
            }
            if($counter < count($order) - 1){
                $this->append(', ');
                $counter++;
            }
        }
        return $this;
    }

    public function delete($table){
        return $this->append('DELETE FROM `' . $table . '` ');
    }

    public function between(){
        $this->append('BETWEEN');
        return $this;
    }

    public function order(){
        $this->append('ORDER');
        return $this;
    }


    public function limit($limit){
        return $this->append(' LIMIT ' . $limit);
    }

    public function row($query){
        return $this->append($query);
    }

}