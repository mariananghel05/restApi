<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜   DB   ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\

class Security{
    public static function protect($string){
        if($string="auth:admin"){
            $auth = getallheaders();
            if(empty($auth["Authorization"])){
                Response::response("Unauthorized", 401);
                exit;
            }
            else
                $auth = $auth["Authorization"];

            
            if($auth == "Bearer 6|9truZtjtroGgDU6uQYrG00b2JLrs8E5bOv0uoZkq")
                return new class(){
                    public function group($routes){
                        foreach($routes as $route){
                            if(gettype($route) != NULL)
                                echo $route;
                        }
                    }
                };
            else{
                Response::response("Unauthorized", 401);
                exit;
            }
        }
    }
}