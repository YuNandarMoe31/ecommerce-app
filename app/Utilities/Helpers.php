<?php

use App\Models\Product;

class Helpers {

    public static function userDefaultImage()
    {
        return asset('frontend/img/default_avatar.jpg');
    }

    public static function minPrice()
    {
        return floor(Product::min('offer_price'));
    }

    public static function maxPrice()
    {
        return floor(Product::max('offer_price'));
    }
}