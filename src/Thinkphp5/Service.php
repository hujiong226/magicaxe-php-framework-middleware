<?php
namespace Magicaxe\Thinkphp5;

use think\Db;

abstract class Service
{
    public static function getTableName($table_name)
    {
        return config('database.prefix') . $table_name;
    }

    public static function insert($sql, $sql_val = [])
    {
        return Db::execute($sql, $sql_val);
    }

    public static function delete($sql, $sql_val = [])
    {
        return Db::execute($sql, $sql_val);
    }

    public static function update($sql, $sql_val = [])
    {
        return Db::execute($sql, $sql_val);
    }
    
    public static function read($sql, $sql_val = [])
    {
        return Db::query($sql, $sql_val);
    }
    
    public static function readOne($sql, $sql_val = [])
    {
        $rows = $this->read($sql, $sql_val);
        return array_shift($rows);
    }
    
    public static function getLastInsID($table_name)
    {
        return Db::name($table_name)->getLastInsID();
    }
}