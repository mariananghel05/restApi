<?php

class User extends Model {
    public static function init(){
        $user = new Table('user');
        $user->int('id')->PK()->auto_increment();
        $user->string('name')->nullable();
        $user->string('username')->unique();
        $user->string('password');
        $user->string('email')->unique();
        $user->timestamp('registration_date')->default('CURRENT_TIMESTAMP');
        $user->int('acces_level')->default(10); 
        $user->date('birth_date')->default('CURRENT_TIMESTAMP');
        $user->int('age')->default(0);
        $user->int('permissions_id')->FK('permissions', 'id');
        Response::response($user->done());
    }

    public static function show(){
        $users = DB::query("SELECT * FROM user WHERE name LIKE '%'");

        //DB::query("DELETE FROM user");
        Response::response($users[0]);
    }
    public static function show2($r){
        $r->name;
    }


}