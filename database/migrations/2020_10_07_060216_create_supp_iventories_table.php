<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppIventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supp_iventories', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->unsignedBigInteger('consign_id');
            $table->string('consign_ref');
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
        Schema::dropIfExists('supp_iventories');
    }
}
