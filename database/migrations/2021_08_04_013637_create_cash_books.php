<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('code_cash_book_id');
            $table->text('note');
            $table->integer('income');
            $table->integer('outcome');
            $table->timestamps();
            $table->foreign('code_cash_book_id')
                ->references('id')
                ->on('code_cash_books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('product_type_id')
                ->references('id')
                ->on('product_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_books');
    }
}
