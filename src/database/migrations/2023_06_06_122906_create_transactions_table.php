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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->text('recipient_address')->nullable();
            $table->double('recipient_latitude')->nullable();
            $table->double('recipient_longitude')->nullable();
            $table->bigInteger('total')->nullable();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
