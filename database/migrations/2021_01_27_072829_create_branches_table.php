<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('npwp');
            $table->timestamps();
        });

        DB::table('branches')->insert([
            [
                'id' => 1,
                'name' => 'Pekanbaru',
                'city' => 'Pekanbaru',
                'address' => 'Pekanbaru',
                'phone' => 'Pekanbaru',
                'npwp' => 'Pekanbaru',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'id' => 16,
                'for' => 'Branch',
                'name' => 'branch-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 17,
                'for' => 'Branch',
                'name' => 'branch-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 18,
                'for' => 'Branch',
                'name' => 'branch-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 19,
                'for' => 'Branch',
                'name' => 'branch-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
        ]);

        DB::table('permission_role')->insert([
            ['role_id' => 1,'permission_id' => 16],
            ['role_id' => 1,'permission_id' => 17],
            ['role_id' => 1,'permission_id' => 18],
            ['role_id' => 1,'permission_id' => 19],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
