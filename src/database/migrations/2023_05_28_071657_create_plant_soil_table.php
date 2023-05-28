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
        Schema::create('plant_soil', function (Blueprint $table) {
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('soil_id');

            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->foreign('soil_id')->references('id')->on('soils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_soil');
    }
};
