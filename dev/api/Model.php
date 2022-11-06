<?php


abstract class Model{
    protected static $table = null;
    public static function create_table(){
        self::$table = new Table(get_called_class());
        return self::$table;
        
    }
}