<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'stock',
        'price',
        'offer_price',
        'discount',
        'condition',
        'status',
        'photo',
        'size',
        'seller_id',
        'cat_id',
        'child_cat_id',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function rel_prods()
    {
        return $this->hasMany(Product::class, 'cat_id')->where('status', 'active')->limit(10);
    }

    public static function getProductByCart($id)
    {
        if (!$id) {
            return null; // Return null or handle the case appropriately
        }

        return self::where('id', $id)->get()->toArray();
    }
}
