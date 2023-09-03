<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'product_id',
        'sub_total',
        'total_amount',
        'quantity',
        'delivery_charge',
        'coupon',
        'payment_method',
        'payment_status',
        'condition',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'country',
        'city',
        'state',
        'postcode',
        'note',
        'sfirst_name',
        'slast_name',
        'semail',
        'sphone',
        'saddress',
        'scountry',
        'scity',
        'sstate',
        'spostcode',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }
}
