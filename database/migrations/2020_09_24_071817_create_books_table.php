<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('copyright')->nullable();
            $table->smallInteger('year')->nullable();
            $table->string('country')->nullable();
            $table->string('cover')->nullable();
            $table->text('summary')->nullable();
            $table->string('book_name');
            $table->string('category');
            $table->string('publisher');
            $table->string('edition')->nullable();
            $table->string('language')->nullable();
            $table->string('ref')->nullable();
            $table->string('status')->nullable();
            $table->integer('isbn_serial')->nullable();
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
}
