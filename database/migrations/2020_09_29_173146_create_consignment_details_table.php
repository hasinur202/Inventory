<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consignment_id');
            $table->foreign('consignment_id')->references('id')->on('consignments');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('book_id')->references('id')->on('books');
            $table->float('cost_price');
            $table->float('pub_price');
            $table->float('sales_price');
            $table->float('total_price');
            $table->integer('qty');
            $table->float('conv_rate');
            $table->float('st_rate');
            $table->string('currency');
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
        Schema::dropIfExists('consignment_details');
    }
}
