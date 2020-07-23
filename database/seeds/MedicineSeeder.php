<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Medicine;

class MedicineSeeder extends Seeder
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
            Medicine::create([
                'name' => $faker->text($maxNbChars = 15),
                'urlImage' => $faker->text($maxNbChars = 15),
                'description' => $faker->text($maxNbChars = 25),
                'dosage' => $faker->text($maxNbChars = 5)
            ]);
        }
    }
}
