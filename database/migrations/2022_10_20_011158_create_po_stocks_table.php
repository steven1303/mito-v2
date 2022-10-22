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
        Schema::create('po_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->string('po_no')->unique();
            $table->bigInteger('spbd_id')->default(0);
            $table->bigInteger('vendor_id')->default(0);
            $table->dateTime('approve')->nullable();
            $table->string('status');
            $table->decimal('ppn', 20, 3)->default(0);
            $table->string('username');
            $table->dateTime('request')->nullable();
            $table->dateTime('print')->nullable();
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'for' => 'PoStock',
                'name' => 'po-stock-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-request',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-verify1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-verify2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-approve',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'PoStock',
                'name' => 'po-stock-print',
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
        Schema::dropIfExists('po_stocks');
    }
};
