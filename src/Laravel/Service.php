<?php
namespace Magicaxe\Laravel;

use Illuminate\Support\Facades\DB;

abstract class Service
{
    public static function getTableName($table_name)
    {
        return DB::getTablePrefix() . $table_name;
    }
    
    public static function insert($sql, $sql_val = [])
    {
        return DB::insert($sql, $sql_val);
    }
    
    public static function delete($sql, $sql_val = [])
    {
        return DB::delete($sql, $sql_val);
    }
    
    public static function update($sql, $sql_val = [])
    {
        return DB::update($sql, $sql_val);
    }
    
    public static function read($sql, $sql_val = [])
    {
        return std_decode(DB::select($sql, $sql_val));
    }
    
    public static function readOne($sql, $sql_val = [])
    {
        $rows = $this->read($sql, $sql_val);
        return array_shift($rows);
    }
    
    public static function getLastInsID($table_name)
    {
        return DB::table($table_name)->insertGetId();
    }
}