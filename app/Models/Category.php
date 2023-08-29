<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'photo',
        'summary',
        'is_parent',
        'parent_id',
        'status'
    ];

    public static function shiftChild($cat_id) 
    {
        return Category::whereIn('id', $cat_id)->update(['is_parent'=> 1]);
    }

    public static function getChildByParentId($id)
    {
        return Category::where('parent_id', $id)->pluck('title', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id')->where('status', 'active');
    }
}
