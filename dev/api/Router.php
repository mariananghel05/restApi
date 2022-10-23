<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜ Router  ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\

class Router{
    
    public static function get(string $path, $action = null){
        if($_SERVER['REQUEST_METHOD'] == "GET")
            if(explode("?",$_SERVER['REQUEST_URI'])[0] == $path)
                return $action(self::request());

    }
    public static function post(string $path, $action = null){
        if($_SERVER['REQUEST_METHOD'] == "POST")
            if(explode("?",$_SERVER['REQUEST_URI'])[0] == $path)
                return $action(self::request());

    }
    public static function put(string $path, $action = null){
        if($_SERVER['REQUEST_METHOD'] == "PUT")
            if(explode("?",$_SERVER['REQUEST_URI'])[0] == $path)
                return $action(self::request());

    }
    public static function delete(string $path, $action = null){
        if($_SERVER['REQUEST_METHOD'] == "DELETE")
            if(explode("?",$_SERVER['REQUEST_URI'])[0] == $path)
                return $action(self::request());

    }
    public static function resource(string $path, $action){
       // return $action(self::request());
    }  

    private static function request(){
        return new class () {

            public function __construct(){
               $keys = array_keys($_GET);
               foreach($keys as $key){
                  $this->$key = $_GET[$key];
               }
               
               $keys = array_keys($_POST);
               foreach($keys as $key){
                  $this->$key = $_POST[$key];
               }
         
         
               $json = file_get_contents("php://input");
               $arr = (array) json_decode($json);
               $keys = array_keys($arr);
               foreach($keys as $key){
                  $this->$key = $arr[$key];
               }
            }
         };
    }
    public static function setRequestObject($rquest){
        self::$request = $request;
    }
}