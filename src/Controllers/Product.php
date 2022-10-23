<?php 


class Product extends Controller{
    public static function show($request){
        $products = [1=>"Product One", 2=>"Product Two"];
        Response::response($products[$request->id],200);
    }
}