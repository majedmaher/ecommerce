<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeGetData($query)
    {
        $lang = getLanguage();
        return $query->select('id', 'category_name_' . $lang . ' as category_name', 'category_slug_' . $lang . ' as category_slug', 'category_image');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
