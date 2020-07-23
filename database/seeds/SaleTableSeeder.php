<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Sale;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<20;$i++){
            Sale::create([
                'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
                'user_medicine_id' => $faker->numberBetween($min = 1, $max = 100),
            ]);
        }
    }
}
