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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('phone');
            $table->string('pic')->nullable();
            $table->string('telp')->nullable();
            $table->string('npwp');
            $table->bigInteger('tax_id')->default(1);
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'for' => 'Vendor',
                'name' => 'vendor-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Vendor',
                'name' => 'vendor-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Vendor',
                'name' => 'vendor-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Vendor',
                'name' => 'vendor-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updad_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Vendor',
                'name' => 'vendor-info',
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
        Schema::dropIfExists('vendors');
    }
};
