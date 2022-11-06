<?php


abstract class Model{
    public static function create_controller($obj){
        Response::response($obj);
    }
}