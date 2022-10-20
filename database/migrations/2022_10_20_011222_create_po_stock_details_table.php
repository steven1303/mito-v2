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
        Schema::create('po_stock_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->bigInteger('po_id')->unsigned();
            $table->bigInteger('spbd_detail_id')->default(0);
            $table->bigInteger('stock_master_id');
            $table->decimal('qty', 10, 2)->default(0);
            $table->decimal('price', 20, 3)->default(0);
            $table->decimal('disc', 20, 3)->default(0);
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('po_id')->references('id')->on('po_stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_stock_details');
    }
};
