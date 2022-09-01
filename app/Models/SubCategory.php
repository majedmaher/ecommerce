<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeGetData($query)
    {
        $lang = getLanguage();
        return $query->select('id', 'category_id', 'sub_category_name_' . $lang . ' as sub_category_name', 'sub_category_slug_' . $lang . ' as sub_category_slug', 'sub_category_image');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
