<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceRecipientTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_recipient_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipient_id')->unsigned();
            $table->string('name');
            $table->text('address');
            $table->string('mol');
            $table->timestamps();

            $table->foreign('recipient_id')->references('id')->on('invoice_recipients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_recipient_translations');
    }
}
