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
        Schema::create('transfer_branch_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->bigInteger('transfer_branch_id')->unsigned();
            $table->bigInteger('stock_master_id');
            $table->decimal('qty', 10, 3)->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('transfer_branch_details');
    }
};
