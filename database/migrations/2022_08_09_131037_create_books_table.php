<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('book_name', 100);
            $table->text('book_description');

            $table->string('book_format', 10);
            $table->integer('book_pages');
            $table->double('book_weight');
            $table->integer('book_publishing_year');

            $table->double('book_price');
            $table->double('book_price_sale');

            $table->integer('menu_id');
            $table->integer('publisher_id');

            $table->string('book_thumb', 100);
            $table->integer('book_active');
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
        Schema::dropIfExists('books');
    }
};
