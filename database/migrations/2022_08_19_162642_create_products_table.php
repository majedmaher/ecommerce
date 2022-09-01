<?php

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(SubCategory::class)->nullable()->constrained()->onDelete('cascade');
            $table->string('product_name_en');
            $table->string('product_name_ar');
            $table->string('product_slug_en');
            $table->string('product_slug_ar');

            $table->string('product_qty');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_ar')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_ar');

            $table->string('selling_price');
            $table->string('discount_price')->nullable();

            $table->text('short_product_description_en');
            $table->text('short_product_description_ar');
            $table->text('long_product_description_en');
            $table->text('long_product_description_ar');
            $table->text('additional_information_en');
            $table->text('additional_information_ar');
            $table->text('additional_information_items_en')->nullable();
            $table->text('additional_information_items_ar')->nullable();

            $table->char('trandy', 1)->nullable();
            $table->char('just_arrived', 1)->nullable();
            $table->char('spring_collection', 1)->nullable();
            $table->char('summer_collection', 1)->nullable();
            $table->char('fall_collection', 1)->nullable();
            $table->char('winter_collection', 1)->nullable();
            $table->char('status', 1)->nullable();
            $table->string('product_thambnail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
