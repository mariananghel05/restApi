<?php

class User{
    public function login($vars){
        $user = (DB::query("SELECT * FROM user WHERE username=:un AND password=:pw", ["un"=>$vars['username'], "pw"=>$vars['password']]));
        if(empty($user)){
          header('HTTP/1.1 401 Unauthorized');  
			    return ['status_code'=>401, "message"=>'Login failed! Wrong Username or Password!'];  
        }
        else
            $user = $user[0];
        
        $token = Authorization::genToken('{"username": "' . $user['username'] . '", "id": "' . $user['id'] . '", "first_name": "' . $user['first_name'] . '"}', $_SERVER["REQUEST_TIME_FLOAT"]);
        //setcookie("token", $token, time()+3600, "/");
        DB::query("INSERT INTO tokens(`user_id`, `token`) VALUES (:user_id, :token)", ["user_id"=>$user['id'], "token"=>$token]);
        return $token;
}

public function fetchUser($vars){
  if(isset(getallheaders()["Authorization"]))
    $token = getallheaders()["Authorization"];
  if(isset($_COOKIE['Authorization']))
    $token = $_COOKIE['Authorization'];
  if(isset($_GET['Authorization']))
    $token = $_GET['Authorization'];
  if(isset($_POST['Authorization']))
    $token = $_POST['Authorization'];

  if(!isset($token))
    return false;

  $payload = Authorization::getPayload($token);

  $id = $payload['id'];

  $user = DB::query("SELECT * FROM user WHERE id=:id", ["id"=>$id]);
  if(!empty($user) && count($user) == 1)
    return $user[0];
  else 
    return false;
}

public function init($vars){
    $query = 
'CREATE TABLE `language` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `class` (
    `id` int,
    `name` char(64),
    `master_id` int,
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `access_level` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  
  CREATE TABLE `user` (
    `id` int NOT NULL PRIMARY KEY,
    `username` varchar(255) UNIQUE NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) UNIQUE NOT NULL,
    `phone` int,
    `first_name` varchar(255),
    `last_name` varchar(255),
    `registration_date` date DEFAULT CURRENT_TIMESTAMP,
    `access_level` int DEFAULT 10,
    `birth_date` date,
    `age` int DEFAULT 0,
    `class_id` int DEFAULT NULL,
    `function_id` int DEFAULT NULL,
    `language_id` int DEFAULT 1
  );
  ALTER TABLE `user` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT; 

  CREATE TABLE `function` (
    `id` int,
    `name` char(64),
    PRIMARY KEY (`id`)
  );
  
ALTER TABLE `class`
    ADD CONSTRAINT `master_id`
    FOREIGN KEY (`master_id`)
    REFERENCES `user`(`id`);

  
ALTER TABLE `user`
    ADD CONSTRAINT `language_id`
    FOREIGN KEY (`language_id`)
    REFERENCES `language`(`id`);
  
ALTER TABLE `user`
    ADD CONSTRAINT `class_id`
    FOREIGN KEY (`class_id`)
    REFERENCES `class`(`id`);

ALTER TABLE `user`
    ADD CONSTRAINT `access_level`
    FOREIGN KEY (`access_level`)
    REFERENCES `access_level`(`id`);

SET foreign_key_checks = 0;
 INSERT INTO language(`id`, `name`) VALUES'." (1, 'ROMANA');".
'INSERT INTO `user`(`username`, `password`, `email`, `phone`, `first_name`, `last_name`, `access_level`, `birth_date`, `age`, `class_id`, `function_id`, `language_id`) VALUES '."('anghelmarian05', '1234', 'mariananghel99@gmail.com', 0769698932, 'Marian', 'Anghel', 0, '1999-01-05', 23, NULL, 1, 1);".
'INSERT INTO `access_level`(`id`, `name`) VALUES ' . "(1,'Administrator');".
'INSERT INTO `function`(`id`, `name`) VALUES ' . "(1,'Analist Programator');".
'SET foreign_key_checks = 1;



  ';
  
  return DB::query($query, null);
}

}