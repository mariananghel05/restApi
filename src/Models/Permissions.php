<?php



class Permissions{
    public static function init(){
        $table = new Table('permissions');
        $table->int('id')->PK()->auto_increment();
        $table->string('name');
        $table->done();
    }
}