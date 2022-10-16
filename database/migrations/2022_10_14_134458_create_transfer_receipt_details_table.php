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
        Schema::create('transfer_receipt_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->bigInteger('transfer_receipt_id')->unsigned();
            $table->bigInteger('transfer_branch_detail_id');
            $table->bigInteger('stock_master_from_id');
            $table->bigInteger('stock_master_id');
            $table->decimal('qty', 10, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->string('transfer_receipt_detail_status');
            $table->timestamps();

            $table->foreign('transfer_receipt_id')->references('id')->on('transfer_receipts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_receipt_details');
    }
};
