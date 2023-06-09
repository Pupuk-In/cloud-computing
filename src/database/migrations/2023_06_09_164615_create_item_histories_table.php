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
        Schema::create('item_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_item_id');
            $table->string('name');
            $table->json('picture');
            $table->text('description');
            $table->string('type');
            $table->json('plant');
            $table->json('plant_part');
            $table->integer('price');
            $table->string('brand');
            $table->timestamps();

            $table->foreign('transaction_item_id')->references('id')->on('transaction_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_histories');
    }
};
