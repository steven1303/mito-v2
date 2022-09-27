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
        Schema::create('stock_masters', function (Blueprint $table) {
            $table->id();
            $table->string('stock_no')->unique();
            $table->bigInteger('branch_id');
            $table->string('bin');
            $table->string('name');
            $table->string('satuan')->nullable();
            $table->decimal('min_soh', 15, 3)->default(0);
            $table->decimal('max_soh', 15, 3)->default(0);
            $table->decimal('harga_modal', 20, 3)->default(0);
            $table->decimal('harga_jual', 20, 3)->default(0);
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'for' => 'StockMaster',
                'name' => 'stock-master-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'StockMaster',
                'name' => 'stock-master-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'StockMaster',
                'name' => 'stock-master-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'StockMaster',
                'name' => 'stock-master-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'StockMaster',
                'name' => 'stock-master-movement',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_masters');
    }
};
