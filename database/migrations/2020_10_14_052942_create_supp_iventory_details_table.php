<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppIventoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supp_iventory_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supp_id');
            $table->foreign('supp_id')->references('id')->on('supp_iventories');
            $table->float('pay')->nullable();
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
        Schema::dropIfExists('supp_iventory_details');
    }
}
