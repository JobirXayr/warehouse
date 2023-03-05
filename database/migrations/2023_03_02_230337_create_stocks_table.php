<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('product_id');
            $table->string('supply_number'); // номер поставки
            $table->string('order_number')->nullable(); // номер заказа
            $table->integer('amount');
            $table->double('price');
            $table->tinyInteger('supply_order'); // поставка = 1, заказ = -1
            $table->date('day');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
