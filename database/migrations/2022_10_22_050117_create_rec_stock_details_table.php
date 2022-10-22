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
        Schema::create('rec_stock_details', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('branch_id');
            $table->bigInteger('rec_id')->unsigned();
            $table->bigInteger('po_detail_id')->default(0);
            $table->bigInteger('stock_master_id');
            $table->decimal('receive', 10, 2)->default(0);
            $table->decimal('price', 10, 3)->default(0);
            $table->decimal('disc', 10, 3)->default(0);
            $table->string('keterangan')->nullable();
            $table->string('detail_status')->nullable();
            $table->timestamps();

            $table->foreign('rec_id')->references('id')->on('rec_stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rec_stock_details');
    }
};
