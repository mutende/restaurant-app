<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('invoice_id')->unsigned()->nullable();
          $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('product_id')->unsigned()->nullable();
          $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
          $table->double('quantity');
          $table->double('price');
          $table->double('total');
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
        Schema::dropIfExists('invoice_details');
    }
}
