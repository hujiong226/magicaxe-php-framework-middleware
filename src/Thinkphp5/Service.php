<?php
namespace Magicaxe\Thinkphp5;

use think\Db;

abstract class Service
{
    private $table;
    private $field;
    private $where;
    private $group;
    private $order;
    private $limit;
    private $sql;
    private $sql_val;
    
    public function table($table_name)
    {
        $this->table = $this->getTableName($table_name);
        $this->field = '*';
        $this->where = '';
        $this->group = '';
        $this->order = '';
        $this->limit = '';
        $this->sql = '';
        $this->sql_val = [];
        
        return $this;
    }

    public function getTableName($table_name)
    {
        return config('database.prefix') . $table_name;
    }
    
    public function field($field)
    {
        $this->field = $field;
        
        return $this;
    }
    
    public function where($where_condition, $sql_val = [])
    {
        $this->where = 'where ' . $where_condition;
        if(!empty($sql_val)) $this->sql_val = $sql_val;
        
        return $this;
    }
    
    public function group($group_condition)
    {
        $this->group = 'group by ' . $group_condition;
        
        return $this;
    }
    
    public function order($order_condition)
    {
        $this->order = 'order by ' . $order_condition;
        
        return $this;
    }
    
    public function limit($limit)
    {
        $this->limit = 'limit ' . $limit;
        
        return $this;
    }
    
    public function read($sql = '', $sql_val = [])
    {
        if(!empty($sql))
        {
            return Db::query($sql, $sql_val);
        }
        else
        {
            $this->sql = "select " . $this->field . " from " . $this->table . " " . $this->where . " " . $this->group . " " . $this->order . " " . $this->limit . ";";
            return Db::query($this->sql, $this->sql_val);
        }
    }
    
    public function readOne($sql = '', $sql_val = [])
    {
        $rows = $this->read($sql, $sql_val);
        return array_shift($rows);
    }
    
    public function insert($data_list)
    {
        if(count($data_list) == 1)
        {
            return Db::table($this->table)->insert($data_list);
        }
        else
        {
            return Db::table($this->table)->insertAll($data_list);
        }
    }
    
    public function getLastInsID()
    {
        return Db::table($this->table)->getLastInsID();
    }

    public function update($sql_val = [])
    {
        $this->sql = "update " . $this->table . " set " . $this->field . " " . $this->where . ";";
        if(!empty($sql_val))
        {
            $this->sql_val = array_merge($this->sql_val, $sql_val);
        }
        
        return Db::execute($this->sql, $this->sql_val);
    }
    
    public function delete()
    {
        $this->sql = "delete from " . $this->table . " " . $this->where . ";";
        
        return Db::execute($this->sql, $this->sql_val);
    }
    
    public function getSql()
    {
        return $this->sql;
    }
    
    public function getSqlVal()
    {
        return $this->sql_val;
    }
}