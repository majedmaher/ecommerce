<?php

use App\Models\Orders;
use App\Models\Product;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Orders::class)->constrained()->onDelete('cascade');

            // $table->unsignedBigInteger('order_id');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignIdFor(Product::class)->constrained();
            $table->string('product_slug');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('qty');
            $table->float('price', 8, 2);
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
        Schema::dropIfExists('order_items');
    }
};
