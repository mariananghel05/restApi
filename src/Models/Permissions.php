<?php

class Permissions extends Model{
    public static function init(){
        self::create_table();
        self::$table->int('id')->PK()->auto_increment();
        self::$table->string('name');
        self::$table->done();
        Response::response("done");
    }
}