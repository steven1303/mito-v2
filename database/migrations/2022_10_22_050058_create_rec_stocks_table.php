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
        Schema::create('rec_stocks', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('branch_id');
            $table->string('rec_no')->unique();
            $table->bigInteger('vendor_id');
            $table->bigInteger('po_stock_id')->default(0);
            $table->string('rec_inv_ven');
            $table->dateTime('approved')->nullable();
            $table->decimal('ppn', 10, 3)->default(0);
            $table->string('status');
            $table->string('username');
            $table->dateTime('print')->nullable();
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'for' => 'Receipt',
                'name' => 'receipt-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Receipt',
                'name' => 'receipt-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Receipt',
                'name' => 'receipt-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Receipt',
                'name' => 'receipt-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Receipt',
                'name' => 'receipt-open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Receipt',
                'name' => 'receipt-print',
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
        Schema::dropIfExists('rec_stocks');
    }
};
