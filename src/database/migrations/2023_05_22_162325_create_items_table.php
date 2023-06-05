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
            $table->text("description");
            $table->unsignedBigInteger('type_id');
            $table->bigInteger("price");
            $table->bigInteger("stock");
            $table->bigInteger("sold");
            $table->float("rating")->nullable();
            $table->text("relevance")->nullable();
            $table->string("brand")->nullable();
            $table->unsignedBigInteger('store_id');
            $table->timestamps();
            $table->softDeletes();

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
