<?php


class Product{
    protected int $id;
    protected int $userId;
    protected string $name;
    protected string $description;
    protected float $price;
    protected string $slug;

    public static function getprops(){
        return  self::get_vars();
    }
}