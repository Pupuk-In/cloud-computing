<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

        // make me an SQL trigger where if the column 'price' on the table 'cart_items' is updated the column 'total' will get a sum of all the 'price' columns on the table 'cart_items' where the 'cart_id' is the same as the 'id' of the row that was updated
        DB::unprepared('
            CREATE OR REPLACE FUNCTION update_cart_total()
            RETURNS TRIGGER
            LANGUAGE PLPGSQL
            AS $$
            BEGIN
                UPDATE carts
                SET total = (
                    SELECT SUM(price)
                    FROM cart_items
                    WHERE cart_id = NEW.cart_id
                )
                WHERE id = NEW.cart_id;
                RETURN NEW;
            END;
            $$;

            CREATE TRIGGER update_cart_total_trigger
            AFTER INSERT OR UPDATE ON cart_items
            FOR EACH ROW
            EXECUTE FUNCTION update_cart_total();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER update_cart_total_trigger ON cart_items;');
        DB::unprepared('DROP FUNCTION update_cart_total();');
        Schema::dropIfExists('cart_items');
    }
};
