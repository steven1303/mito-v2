<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('for');
            $table->integer('stat')->default(0);
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigInteger('role_id');
            $table->bigInteger('permission_id');
        });

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'for' => 'Admins',
                'name' => 'admin-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 2,
                'for' => 'Admins',
                'name' => 'admin-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 3,
                'for' => 'Admins',
                'name' => 'admin-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 4,
                'for' => 'Admins',
                'name' => 'admin-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 5,
                'for' => 'Admins',
                'name' => 'admin-profile',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 6,
                'for' => 'Admins',
                'name' => 'admin-branch',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 7,
                'for' => 'Roles',
                'name' => 'role-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 8,
                'for' => 'Roles',
                'name' => 'role-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 9,
                'for' => 'Roles',
                'name' => 'role-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 10,
                'for' => 'Roles',
                'name' => 'role-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 11,
                'for' => 'Roles',
                'name' => 'role-permission',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 12,
                'for' => 'Permissions',
                'name' => 'permission-view',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 13,
                'for' => 'Permissions',
                'name' => 'permission-store',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 14,
                'for' => 'Permissions',
                'name' => 'permission-update',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
            [
                'id' => 15,
                'for' => 'Permissions',
                'name' => 'permission-delete',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'stat' => 1,
            ],
        ]);

        DB::table('permission_role')->insert([
            ['role_id' => 1,'permission_id' => 1],
            ['role_id' => 1,'permission_id' => 2],
            ['role_id' => 1,'permission_id' => 3],
            ['role_id' => 1,'permission_id' => 4],
            ['role_id' => 1,'permission_id' => 5],
            ['role_id' => 1,'permission_id' => 6],
            ['role_id' => 1,'permission_id' => 7],
            ['role_id' => 1,'permission_id' => 8],
            ['role_id' => 1,'permission_id' => 9],
            ['role_id' => 1,'permission_id' => 10],
            ['role_id' => 1,'permission_id' => 11],
            ['role_id' => 1,'permission_id' => 12],
            ['role_id' => 1,'permission_id' => 13],
            ['role_id' => 1,'permission_id' => 14],
            ['role_id' => 1,'permission_id' => 15],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
