<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('hotel');
            $table->unsignedTinyInteger('duration')->comment('Duration in days');
            $table->unsignedTinyInteger('tourists_number');
            $table->date('departure_date');
            $table->string('food');
            $table->string('note');
            $table->unsignedInteger('main_image_id')->nullable();
            $table->text('description');
            $table->decimal('price');

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
        Schema::dropIfExists('tours');
    }
}
