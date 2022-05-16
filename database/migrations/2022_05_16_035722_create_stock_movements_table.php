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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_stock_master');
            $table->bigInteger('id_branch');
            $table->dateTime('move_date');
            $table->string('type');
            $table->string('doc_no');
            $table->decimal('order_qty', 15, 3)->default(0);
            $table->decimal('sell_qty', 15, 3)->default(0);
            $table->decimal('in_qty', 15, 3)->default(0);
            $table->decimal('out_qty', 15, 3)->default(0);
            $table->decimal('harga_modal', 20, 3)->default(0);
            $table->decimal('harga_jual', 20, 3)->default(0);
            $table->string('user');
            $table->integer('status')->default(0);
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('stock_movements');
    }
};
