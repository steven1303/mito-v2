<?php

namespace Database\Seeders\Inventory;

use App\Models\StockMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockMaster::factory()->times(10)->create();
    }
}
