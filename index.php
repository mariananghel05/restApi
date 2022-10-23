<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜ Index.php ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
header("Content-Type", "application/json");

require_once('config.php');
require_once('autoload.php');



DB::setDB(CONFIG->db->server, CONFIG->db->name, CONFIG->db->password, CONFIG->db->db);
//echo Response::response(Auth::genToken(json_encode(["dum"=>"dumest"]), "parolamea"));
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
Router::get(CONFIG->app->publicPath . "/users", [User::class, 'show']);
Security::protect("auth:admin")->group([
Router::get(CONFIG->app->publicPath . "/product", [Product::class, 'show']),
Router::post(CONFIG->app->publicPath . "/product", [Product::class, 'show'])
]);
