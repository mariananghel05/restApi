<?php

class Table{

    public function __construct($table_name, $controller_path = "src/Controllers/"){
        $this->controller_path = $controller_path;
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
            $this->props[$this->current_prop] .= ", FOREIGN KEY `fk_".$this->current_prop."`(`".$this->current_prop."`) REFERENCES `".$table . "`(`".$column."`) ON UPDATE CASCADE ON DELETE CASCADE";
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
            $message = DB::query($query);
            $this->create_controller($this->controller_path);
            return $message;
        }
        public function create_controller($path){
            if($path){
                $controller = "<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜ ".$this->name."  ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\\

class ".$this->name." extends Controller \n{\n";
                $keys = array_keys($this->props);
                foreach($keys as $key){
                    $controller .= "protected static $" . $key . " = null;\n";
                }
                $controller .= "\n}";

                file_put_contents($path . $this->name . ".php",$controller);
            }
            return 1;
        
        }

        public function populate($number){
            $keys = array_keys($this->props);
            $ss = implode('`, `', $keys);
            for($i=0; $i<$number; $i++){

            str_replace(["registration_date", "birth_date"], "", $ss );
            $query = "INSERT INTO `" . $this->name . "`(`" . $ss ."`) VALUES (";
            $query .="";
            foreach($keys as $key) {
                $query .=  random_int(0, 9999999) . ", ";
            }
            $query = substr($query, 0, -3);
            $query .= ")";
            echo $query;
            DB::query($query);
            }
        }
    }
