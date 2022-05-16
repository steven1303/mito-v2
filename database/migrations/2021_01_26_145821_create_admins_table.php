<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('picture')->nullable();
            $table->string('password');
            $table->bigInteger('role_id');
            $table->bigInteger('branch_id');
            $table->Integer('status_akses')->default(0);
            $table->timestamps();
        });

        DB::table('admins')->insert([
            'name' => 'administrator',
            'username' => 'administrator',
            'email' => 'admin@mail.com',
            'picture' => '',
            'password' => Hash::make('12341234'),
            'role_id' => 1,
            'branch_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
