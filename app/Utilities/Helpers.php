<?php

use App\Models\Product;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;

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

    // currency 
    public static function currency_load()
    {
        if(session()->has('system_default_currency_info') == false) {
            session()->put('system_default_currency_info', \App\Models\Currency::where('status','active')->find(1));
        }
    }

    // currency converter
    public static function currency_converter($amount) 
    {
        return format_price(convert_price($amount));
    }
}

// convert price
// if(!function_exists('convert_price')) {
//     function convert_price($price) {
//         Helpers::currency_load();
//         $system_default_currency_info = session('system_default_currency_info');
//         $price = floatval($price)/floatval($system_default_currency_info->exchange_rate);
    
//         if(Session::has('exchange_rate')) {
//             $exchange = session('currency_exchange_rate');
//         } else {
//             $exchange = $system_default_currency_info->exchange_rate;
//         }
//         $price = floatval($price) * floatval($exchange);

//         return $price;
//     }
// }
// convert price
//if(!function_exists('convert_price')){
    function convert_price($price){
        
        //$price = floatval($price)/floatval($system_default_currency_info->exchange_rate);

        if(Session::has('currency_exchange_rate')){
            $exchange = session('currency_exchange_rate');
        }else{
            Helpers::currency_load();
            $system_default_currency_info = session('system_default_currency_info');
            $exchange = $system_default_currency_info->exchange_rate;
        }
        $price = floatval($price) * floatval($exchange);
        
        return $price;
    }
//}

// currency symbol
if(!function_exists('currency_symbol')) {
    function currency_symbol() {
        Helpers::currency_load();
        if(session()->has('currency_symbol')) {
            $symbol = session('currency_symbol');
        } else {
            $system_default_currency_info = session('system_default_currency_info');
            $symbol = $system_default_currency_info->symbol;
        }
        return $symbol;
    }
}

// format price
if(!function_exists('format_price')) {
    function format_price($price) {
        return currency_symbol().number_format($price,2);
    }
}

// setting 
if(!function_exists('get_setting')) {
    function get_setting($key) {
        return Setting::value($key);
    }
}