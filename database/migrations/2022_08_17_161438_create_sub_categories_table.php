<?php

use App\Models\Category;
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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->string('sub_category_name_en');
            $table->string('sub_category_name_ar');
            $table->string('sub_category_slug_en');
            $table->string('sub_category_slug_ar');
            $table->string('sub_category_image');
            $table->softDeletes();
            $table->timestamps();

            // $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
