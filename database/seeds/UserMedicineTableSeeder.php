<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\UserMedicine as UsMe;

class UserMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker::create();
        for($i=0; $i<100;$i++){
            UsMe::create([
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
                'user_id' => $faker->numberBetween($min = 1, $max = 11),
                'medicine_id' => $faker->numberBetween($min = 1, $max = 20)
            ]);
        }
    }
}
