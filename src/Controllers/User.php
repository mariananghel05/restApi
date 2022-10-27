<?php

class User extends Controller{
    public static function show(){
        
        Response::response( json_encode(UserModel::getprops()), 200);
    }
}