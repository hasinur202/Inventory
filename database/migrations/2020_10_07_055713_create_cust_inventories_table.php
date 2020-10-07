<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cust_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('cus_name');
            $table->float('total_due');
            $table->float('total_paid')->default(0.00);
            $table->float('pay')->default(0.00);
            $table->float('new_due')->default(0.00);
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
        Schema::dropIfExists('cust_inventories');
    }
}
