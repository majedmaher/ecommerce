<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::create([
            'category_id' => 4,
            'sub_category_name_en' => 'Baby Clothes',
            'sub_category_name_ar' => 'ملابس ولادي',
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', 'Baby Clothes')),
            'sub_category_slug_ar' => strtolower(str_replace(' ', '-', 'ملابس ولادي')),
            'sub_category_image' => 'img/cat-3.jpg',
        ]);

        SubCategory::create([
            'category_id' => 4,
            'sub_category_name_en' => 'Girls Clothes',
            'sub_category_name_ar' => 'ملابس بناتي',
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', 'Girls Clothes')),
            'sub_category_slug_ar' => strtolower(str_replace(' ', '-', 'ملابس بناتي')),
            'sub_category_image' => 'img/product-5.jpg',
        ]);

        SubCategory::create([
            'category_id' => 6,
            'sub_category_name_en' => "Men's Jacket",
            'sub_category_name_ar' => 'جاكيت رجالي',
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', "Men's Jacket")),
            'sub_category_slug_ar' => strtolower(str_replace(' ', '-', 'جاكيت رجالي')),
            'sub_category_image' => 'img/product-3.jpg',
        ]);

        SubCategory::create([
            'category_id' => 6,
            'sub_category_name_en' => "Men Suits",
            'sub_category_name_ar' => 'بدل رجالي',
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', 'Men Suits')),
            'sub_category_slug_ar' => strtolower(str_replace(' ', '-', 'بدل رجالي')),
            'sub_category_image' => 'img/product-6.jpg',
        ]);
    }
}
