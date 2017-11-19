<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('invoice_item_id')->unsigned();
            $table->unsignedInteger('number');
            $table->unsignedInteger('quantity');
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('restrict');
            $table->foreign('invoice_item_id')->references('id')->on('invoice_items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('invoice_invoice_item');
        Schema::enableForeignKeyConstraints();
    }
}
