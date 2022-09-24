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
        Schema::create('adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('adj_id')->unsigned();
            $table->bigInteger('stock_master_id');
            $table->decimal('in_qty', 10, 2)->default(0);
            $table->decimal('out_qty', 10, 2)->default(0);
            $table->decimal('harga_modal', 20, 2)->default(0);
            $table->decimal('harga_jual', 20, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('adj_id')->references('id')->on('adjustments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustment_details');
    }
};
