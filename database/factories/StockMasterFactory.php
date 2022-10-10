<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMaster>
 */
class StockMasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stock_no' => $this->faker->lexify('AA-???'),
            'branch_id' => 1, 
            'bin' => "Bin 1", 
            'name' => $this->faker->word(), 
            'satuan' => "PCS", 
            'min_soh' => $this->faker->numberBetween(0, 10), 
            'max_soh' => $this->faker->numberBetween(11, 100),
        ];
    }
}
