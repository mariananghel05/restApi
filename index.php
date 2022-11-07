<?php
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜ Index.php ⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
//⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜⁜\\
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler");

header("Content-Type", "application/json");



require_once('config.php');
require_once('autoload.php');



DB::setDB(CONFIG->db->server, CONFIG->db->name, CONFIG->db->password, CONFIG->db->db);
//echo Response::response(Auth::genToken(json_encode(["dum"=>"dumest"]), "parolamea"));

Router::get(CONFIG->app->publicPath . "/users", [User::class, 'show']);
Router::get(CONFIG->app->publicPath . "/users2", [User::class, 'show2']);
Router::get(CONFIG->app->publicPath . "/user/init", [User::class, 'init']);
Router::get(CONFIG->app->publicPath . "/product/init", [Product::class, 'init']);
Router::get(CONFIG->app->publicPath . "/permissions/init", [Permissions::class, 'init']);
Router::get(CONFIG->app->publicPath . "/permissions/save", [Permissions::class, 'save']);
Router::get(CONFIG->app->publicPath . "/test", [User::class, 'test']);

Security::protect()->group([
    
    Router::get(CONFIG->app->publicPath . "/product", [Product::class, 'show']),
    Router::post(CONFIG->app->publicPath . "/product", [Product::class, 'show'])
]);

Response::response("Not Found!", 404);
