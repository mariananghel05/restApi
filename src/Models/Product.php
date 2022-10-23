<?php


class Product extends Model{
    protected int $id;
    protected string $name;
    protected string $description;
    protected float $price;
    protected string $slug;

    public static function getprops(){
        return  self::get_vars();
    }
}