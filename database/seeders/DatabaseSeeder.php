<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\StockMaster;
use Database\Seeders\Inventory\BranchSeeder;
use Database\Seeders\Inventory\StockMasterSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            StockMasterSeeder::class,
            BranchSeeder::class
        ]);
    }
}
