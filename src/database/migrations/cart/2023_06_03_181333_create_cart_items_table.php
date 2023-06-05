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
            $table->bigInteger('price')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION update_cart_total()
            RETURNS TRIGGER AS $$
            BEGIN
                IF (TG_OP = \'DELETE\') THEN
                    UPDATE carts
                    SET total = (
                        SELECT COALESCE(SUM(price), 0)
                        FROM cart_items
                        WHERE cart_id = OLD.cart_id
                    ),
                    updated_at = NOW()
                    WHERE id = OLD.cart_id;
                ELSE
                    UPDATE carts
                    SET total = (
                        SELECT COALESCE(SUM(price), 0)
                        FROM cart_items
                        WHERE cart_id = NEW.cart_id
                    ),
                    updated_at = NOW()
                    WHERE id = NEW.cart_id;
                END IF;
                
                RETURN NULL;
            END;
            $$ LANGUAGE plpgsql;
        ');

        // DB::unprepared('
        //     CREATE OR REPLACE FUNCTION update_cart_items_price()
        //     RETURNS TRIGGER AS $$
        //     BEGIN
        //         UPDATE cart_items
        //         SET price = NEW.quantity * (
        //             SELECT price FROM items WHERE id = NEW.item_id
        //         )
        //         WHERE id = NEW.id;

        //         RETURN NEW;
        //     END;
        //     $$ LANGUAGE plpgsql;
        // ');

        DB::unprepared('
            CREATE TRIGGER cart_items_update_trigger
            AFTER INSERT OR UPDATE OR DELETE ON cart_items
            FOR EACH ROW
            EXECUTE FUNCTION update_cart_total();
        ');

        // DB::unprepared('
        //     CREATE TRIGGER update_cart_item_price_trigger
        //     AFTER INSERT OR UPDATE ON cart_items
        //     FOR EACH ROW
        //     EXECUTE FUNCTION update_cart_items_price();
        // ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS cart_items_update_trigger ON cart_items;');
        DB::unprepared('DROP TRIGGER IF EXISTS update_cart_item_price_trigger ON cart_items;');
        DB::unprepared('DROP FUNCTION IF EXISTS update_cart_total();');
        DB::unprepared('DROP FUNCTION IF EXISTS update_cart_item_price();');
        Schema::dropIfExists('cart_items');
    }
};
