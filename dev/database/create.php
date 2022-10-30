<?php

class Table{

    public function __construct($table_name){
        $this->name = $table_name;
        $this->props = ["id" => "int NOT NULL PRIMARY KEY"];
        $this->current_prop = $table_name;
    }
        //types
        public function string($name){
            $this->props[$name]= "`".$name."` CHAR(255) NOT NULL";
            $this->current_prop = $name;
            return $this;   
        }
        public function int($name){
            $this->props[$name] = "`".$name."` INT NOT NULL";
            $this->current_prop = $name;
            return $this;
        }
        public function decimal($name){
            $this->props[$name] = "`".$name."` DECIMAL NOT NULL";
            $this->current_prop = $name;
            return $this;
        }
        public function timestamp($name){
            $this->props[$name] = "`".$name."` TIMESTAMP NOT NULL";
            $this->current_prop = $name;
            return $this;
        }
        public function date($name){
            $this->props[$name] = "`".$name."` DATE NOT NULL";
            $this->current_prop = $name;
            return $this;
        }

        //Properties
        public function PK(){
            $this->props[$this->current_prop] .= " PRIMARY KEY";
            return $this;
        }
        public function FK($table, $column){
            $this->props[$this->current_prop] .= ", FOREIGN KEY `fk_".$this->current_prop."`(`".$this->current_prop."`) REFERENCES `".$table . "`(`".$column."`) ON UPDATE CASCADE ON DELETE RESTRICT";
            return $this;
        }
        public function nullable(){ 
            $this->props[$this->current_prop] = str_replace("NOT NULL", "", $this->props[$this->current_prop]);     
            return $this;
        }
        public function unique(){ 
            $this->props[$this->current_prop] .= " UNIQUE ";
            return $this;
        }
        public function default($value){
            $this->props[$this->current_prop] .= " DEFAULT " . $value . " ";
            return $this;
        }
        public function auto_increment(){
            $this->props[$this->current_prop] .= " AUTO_INCREMENT ";
            return $this;
        }


        public function done(){
            $query = "CREATE TABLE `" . $this->name . "` (";
            $query .= implode(", ", $this->props);
            $query .= ")ENGINE=InnoDB;";
            DB::query($query);
            return $this;
        }
    }
