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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("picture");
            $table->text("description")->nullable();
            $table->integer("price");
            $table->integer("stock");
            $table->integer("sold");
            $table->float("rating")->nullable();
            $table->text("relevance")->nullable();
            $table->string("brand")->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('store_id');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('store_id')->references('id')->on('stores')
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
        Schema::dropIfExists('items');
    }
};
