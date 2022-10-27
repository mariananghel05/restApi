<?php

class Table{

    public function create($table_name){
        return new class($table_name){
            public function __construct($table_name){
                $this->query = "CREATE TABLE " . $table_name . " ( `id` int NOT NULL PRIMARY KEY";
            }
            public function string($name){
                $this->query .= ", `".$name."` char(255) ";
            }
            public function int($name){
                $this->query .= ", `".$name."` int";
            }
            public function decimal($name){
                $this->query .= ", `".$name."` decimal";
            }
            public function timestamp($name){
                $this->query .= ", `".$name."` timestamp";
            }
        };
    }
}