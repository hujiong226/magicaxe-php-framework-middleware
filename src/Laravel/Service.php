<?php
namespace Magicaxe\Laravel;

use Illuminate\Support\Facades\DB;

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
        return DB::getTablePrefix() . $table_name;
    }
    
    public function getSplitTableName($table_name, $id)
    {
        $suffix = intval($id / 1000000);
        if($suffix<=0) $suffix = 1;
        return $this->getTableName($table_name) . '_' . $suffix;
    }
    
    public function field($field)
    {
        $this->field = $field;
        
        return $this;
    }
    
    public function where($where_condition)
    {
        $this->where = 'where ' . $where_condition;
        
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
    
    public function read($sql_val = [], $sql = '')
    {
        $this->sql = $sql == '' ? "select " . $this->field . " from " . $this->table . " " . $this->where . " " . $this->group . " " . $this->order . " " . $this->limit . ";" : $sql;
        $this->sql_val = $sql_val;
        
        $rows = std_decode(DB::select($this->sql, $this->sql_val));
        return $rows;
    }
    
    public function readOne($sql_val = [], $sql = '')
    {
        return array_shift($this->read($sql_val, $sql));
    }
    
    public function insert($data_list)
    {
        return DB::table($this->table)->insert($data_list);
    }
    
    public function getLastInsID()
    {
        return DB::table($this->table)->insertGetId();
    }

    public function update($sql_val = [])
    {
        $this->sql = "update " . $this->table . " set " . $this->field . " " . $this->where . ";";
        $this->sql_val = $sql_val;
        
        return DB::update($this->sql, $this->sql_val);
    }
    
    public function delete($sql_val = [])
    {
        $this->sql = "delete from " . $this->table . " " . $this->where . ";";
        $this->sql_val = $sql_val;
        
        return DB::delete($this->sql, $this->sql_val);
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