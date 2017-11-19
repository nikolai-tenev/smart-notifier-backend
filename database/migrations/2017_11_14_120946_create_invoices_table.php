<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number');
            $table->integer('recipient_id')->unsigned();
            $table->integer('generated_invoice_id')->unsigned();
            $table->timestamps();

            $table->foreign('recipient_id')->references('id')->on('invoice_recipients')->onDelete('restrict');
            $table->foreign('generated_invoice_id')->references('id')->on('generated_invoices')->onDelete('restrict');
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
        Schema::dropIfExists('invoices');
        Schema::enableForeignKeyConstraints();
    }
}
