<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedInteger('video_id')->foreign();
            $table->foreignId('video_id')->constrained('videos');
            $table->string('font_color');
            $table->string('font_family');
            $table->string('pop_time');
            $table->string('background_color');
            $table->string('position');
            $table->string('custom')->nullable();
            $table->timestamps();

            // $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
