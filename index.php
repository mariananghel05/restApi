<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜ Index.php ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
header("Content-Type", "application/json");

require_once('config.php');
require_once('autoload.php');



DB::setDB(CONFIG->db->server, CONFIG->db->name, CONFIG->db->password, CONFIG->db->db);
//echo Response::response(Auth::genToken(json_encode(["dum"=>"dumest"]), "parolamea"));

Router::get(CONFIG->app->publicPath . "/users", [User::class, 'show']);
Router::get(CONFIG->app->publicPath . "/user/init", [User::class, 'init']);

Security::protect()->group([
    
    Router::get(CONFIG->app->publicPath . "/product", [Product::class, 'show']),
    Router::post(CONFIG->app->publicPath . "/product", [Product::class, 'show'])
]);

Response::response("Not Found!", 404);
