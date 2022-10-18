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
        Schema::create('spbd_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('branch_id');
            $table->bigInteger('spbd_id')->unsigned();
            $table->bigInteger('stock_master_id');
            $table->decimal('qty', 10, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->foreign('spbd_id')->references('id')->on('spbds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spbd_details');
    }
};
