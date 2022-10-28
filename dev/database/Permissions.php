<?php


class Permissions{
    public function __construct($permissions = 
    [["name"=>"admin", "write"=>1, "read"=>1, "modify"=>1],
     ["name"=>"user", "write"=>0, "read"=>1, "modify"=>1]
    ]){

    }
    public function verify(){
        
    }
}