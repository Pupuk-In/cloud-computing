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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('picture')->nullable();
            $table->text('address');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('description')->nullable();
            $table->float('rating')->nullable();
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
