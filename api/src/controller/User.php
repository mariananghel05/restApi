<?php

class User{
    public function login($vars){
        $user = (DB::query("SELECT * FROM users WHERE username=:un AND password=:pw", ["un"=>$vars['username'], "pw"=>$vars['password']]));
        if(empty($user))
            return "Login failed! Username or Password are wrong!";
        else
            $user = $user[0];
        
        $token = Authorization::genToken('{"username": "' . $user['username'] . '", "id": "' . $user['id'] . '", "first_name": "' . $user['first_name'] . '"}', $_SERVER["REQUEST_TIME_FLOAT"]);
        setcookie("token", $token, time()+3600, "/");
        return Authorization::getPayload($token);
}

    public function fetchUser($vars){
        return Authorization::getPayload($_COOKIE['token']);
    }
    
}