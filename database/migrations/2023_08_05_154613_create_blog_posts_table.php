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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category_id');
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->string('blog_title');
            $table->string('blog_slug')->nullable();
            $table->text('short_des');
            $table->longText('long_des')->nullable();
            $table->string('photo')->nullable();
            $table->integer('views')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
};
