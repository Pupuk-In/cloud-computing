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
        Schema::create('soils', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("picture");
            $table->text("description");
            $table->double('nitrogen')->nullable();
            $table->double('phospor')->nullable();
            $table->double('calium')->nullable();
            $table->double('ph')->nullable();
            $table->double('temp')->nullable();
            $table->double('humidity')->nullable();

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
        Schema::dropIfExists('soils');
    }
};
