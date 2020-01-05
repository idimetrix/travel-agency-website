<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('title');
            $table->string('short_description');
            $table->text('description');
            $table->unsignedInteger('main_image_id')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreign('main_image_id')->references('id')->on('images')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
