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
        $user->done();

        Response::response("Done.");
    }
}