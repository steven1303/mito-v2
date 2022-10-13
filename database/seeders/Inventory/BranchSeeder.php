<?php

namespace Database\Seeders\Inventory;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::insert([
            [
                'id' => 1,
                'name' => 'PKU',
                'city' => 'Pekanbaru',
                'address' => 'address Pekanbaru',
                'phone' => '+62123456789',
                'npwp' => 'Pekanbaru1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'MDN',
                'city' => 'Medan',
                'address' => 'address Medan',
                'phone' => '+62123456789',
                'npwp' => 'Medan1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'KLM',
                'city' => 'Kalimantan',
                'address' => 'address Kalimantan',
                'phone' => '+62123456789',
                'npwp' => 'Kalimantan1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
