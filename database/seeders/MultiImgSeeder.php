<?php

namespace Database\Seeders;

use App\Models\MultiImg;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MultiImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 18; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                MultiImg::create([
                    'product_id' => $i,
                    'photo_name' => 'img/product-' . $j . '.jpg'
                ]);
            }
        }
    }
}
