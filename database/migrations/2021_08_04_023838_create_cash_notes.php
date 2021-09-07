<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('cash_book_id');
            $table->bigInteger('balance');
            $table->timestamps();
            $table->foreign('cash_book_id')
                ->references('id')
                ->on('cash_books')
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
        Schema::dropIfExists('cash_notes');
    }
}
