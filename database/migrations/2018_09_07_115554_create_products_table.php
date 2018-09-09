<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->increments('primary_id');
          $table->bigInteger('id');
          $table->integer('shop_id')->unsigned();
          $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
          $table->string('url');
          $table->float('price', 10, 2);
          $table->float('baseprice', 8, 2)->nullable();
          $table->string('name')->nullable();
          $table->string('vendor')->nullable();
          $table->string('type')->nullable();
          $table->mediumText('description')->nullable();
          $table->string('currencyId');
          $table->string('available')->nullable();
          $table->string('group_id')->nullable();
          $table->string('delivery')->nullable();
          $table->string('orderingTime')->nullable();
          $table->string('age')->nullable();
          $table->bigInteger('barcode')->nullable();
          $table->string('store')->nullable();
          $table->string('pickup')->nullable();
          $table->integer('local_delivery_cost')->nullable();
          $table->string('typePrefix')->nullable();
          $table->string('model')->nullable();
          $table->string('sales_notes')->nullable();
          $table->string('manufacturer_warranty')->nullable();
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
        Schema::dropIfExists('products');
    }
}
