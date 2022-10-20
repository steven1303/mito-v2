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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->string('name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('email')->nullable();
            $table->string('city');
            $table->string('pic')->nullable();
            $table->string('telp')->nullable();
            $table->string('phone');
            $table->string('npwp');
            $table->decimal('tax')->default(0);
            $table->string('ktp');
            $table->string('bod');
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'for' => 'Customer',
                'name' => 'customer-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Customer',
                'name' => 'customer-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Customer',
                'name' => 'customer-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Customer',
                'name' => 'customer-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'for' => 'Customer',
                'name' => 'customer-info',
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
        Schema::dropIfExists('customers');
    }
};
