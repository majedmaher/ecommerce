<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeProductDetails($query, $lang)
    {
        return $query->select('id', 'category_id', 'sub_category_id', 'product_name_' . $lang . ' as name', 'product_thambnail', 'product_qty', 'product_size_' . $lang . ' as product_size', 'product_color_' . $lang . ' as product_color', 'selling_price', 'discount_price', 'short_product_description_' . $lang . ' as short_product_description', 'long_product_description_' . $lang . ' as long_product_description', 'additional_information_' . $lang . ' as additional_information', 'additional_information_items_' . $lang . ' as additional_information_items')->where('status', '1');
    }

    public function scopeProductMainData($query, $lang)
    {
        return $query->select('id', 'category_id', 'sub_category_id', 'product_name_' . $lang . ' as name', 'product_slug_' . $lang . ' as slug', 'product_qty', 'product_thambnail', 'selling_price', 'discount_price', 'product_size_' . $lang . ' as product_size', 'product_color_' . $lang . ' as product_color')->where('status', '1');
    }

    public function multiImgs()
    {
        return $this->hasMany(MultiImg::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
