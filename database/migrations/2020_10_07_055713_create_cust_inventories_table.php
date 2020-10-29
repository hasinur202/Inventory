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
            $table->unsignedBigInteger('invoice_id');
            $table->string('invoice_ref');
            $table->float('total_due');
            $table->float('total_paid')->nullable();
            $table->float('new_due')->nullable();
            $table->integer('status')->default(1);
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
