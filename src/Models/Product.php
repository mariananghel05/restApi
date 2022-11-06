<?php


class Product{
    public static function init(){
        $product = new Table('product');
        $product->int('id')->PK()->auto_increment();
        $product->int('user_id')->FK('user', 'id');
        $product->string('name');
        $product->string('slug')->nullable();
        $product->done();
        Response::response("Found!", 200);
    }
}