<?php

class User extends Controller{
    public static function show(){
        
        echo json_encode(UserModel::getprops());
    }
}