<?php

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
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('vendor_charge')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('product_code')->nullable();
            $table->integer('product_qty');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->integer('product_selling_price');
            $table->integer('product_discount_price')->nullable();
            $table->integer('actual_price')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->string('hover_image')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('special_offers')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('recently_added')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('status')->default(0);
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
