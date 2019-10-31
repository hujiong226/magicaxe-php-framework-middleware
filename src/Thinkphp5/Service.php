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

    public static function run($sql)
    {
		if(!isset($sql) || empty($sql)) return;

		$sql = str_replace("\r", "\n", $sql);
		$ret = array();
		$num = 0;
		$sql = preg_replace("/\;[ \f\t\v]+/", ';', $sql);
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				Db::execute($query);
			}
		}
		return true;
    }
}