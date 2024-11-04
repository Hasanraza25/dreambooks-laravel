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
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id', 0);
            $table->integer('author_id', 0);
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->string('availability', 100);
            $table->string('price', 100);
            $table->string('rating', 100);
            $table->string('publisher', 100);
            $table->string('country_of_publisher', 100);
            $table->string('isbn', 100);
            $table->string('isbn_10', 100);
            $table->string('audience', 100);
            $table->string('format', 100);
            $table->string('language', 100);
            $table->string('total_pages', 100);
            $table->string('downloaded', 100);
            $table->string('edition_number', 100);
            $table->string('recommended', 100);
            $table->text('description');
            $table->string('book_img', 100);
            $table->string('book_upload', 100);
            $table->string('status', 100);
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
        Schema::dropIfExists('book');
    }
};
