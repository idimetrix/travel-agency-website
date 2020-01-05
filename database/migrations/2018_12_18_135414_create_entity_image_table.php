<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_image', function (Blueprint $table) {
            $table->unsignedInteger('entity_id');
            $table->string('entity_type');
            $table->unsignedInteger('image_id');

            $table->primary(['entity_id', 'entity_type', 'image_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_image');
    }
}
