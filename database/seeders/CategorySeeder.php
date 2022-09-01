<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_name_en' => 'Shoes',
            'category_name_ar' => 'أحذية',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Shoes')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'أحذية')),
            'category_image' => 'img/cat-6.jpg',
        ]);

        Category::create([
            'category_name_en' => 'Bags',
            'category_name_ar' => 'حقائب',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Bags')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'حقائب')),
            'category_image' => 'img/cat-5.jpg',
        ]);

        Category::create([
            'category_name_en' => 'Cameras',
            'category_name_ar' => 'كاميرات',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Cameras')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'كاميرات')),
            'category_image' => 'img/cat-4.jpg',
        ]);

        Category::create([
            'category_name_en' => 'Children',
            'category_name_ar' => 'أطفال',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Children')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'أطفال')),
            'category_image' => 'img/cat-3.jpg',
        ]);

        Category::create([
            'category_name_en' => 'Women',
            'category_name_ar' => 'نساء',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Women')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'نساء')),
            'category_image' => 'img/cat-2.jpg',
        ]);
        Category::create([
            'category_name_en' => 'Men',
            'category_name_ar' => 'رجال',
            'category_slug_en' => strtolower(str_replace(' ', '-', 'Men')),
            'category_slug_ar' => strtolower(str_replace(' ', '-', 'رجال')),
            'category_image' => 'img/cat-1.jpg',
        ]);
    }
}
