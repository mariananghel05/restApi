<?php

class UserModel {
    protected static int $id;
    protected static string $name;
    protected static string $username;
    protected static string $email;
    protected static string $password;

    
    public static function getprops(){
       return  self::get_vars();
    }   

    public static function addId($id){
        self::$id = 1;
    }
}