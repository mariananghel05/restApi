<?php 
//_____________Headers_____________\\
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('HTTP/1.1 200 OK');  
header('Content-type: application/json');

//_____________Includes_____________\\
include_once('./dev/autoload.php');
include_once('./dev/init.php');

//_____________Set Database(servername, user, password, database)_____________\\
DB::setDB("localhost", "root", "", "test");

//_____________Response_____________\\
echo json_encode(Router::getRoute(), JSON_PRETTY_PRINT);

//_____________Execution Time_____________\\
$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
//echo "Process Time: {$time}";