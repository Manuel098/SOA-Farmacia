<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'name' => "Manuel",
            'email' => "asd@asd.asd",
            'password' => bcrypt("asdasdasd")
        ]);
        for($i=0; $i<10;$i++){
            User::create([
                'name' => $faker->text($maxNbChars = 15).$i,
                'email' => $faker->text($maxNbChars = 10).$i.'@gmail.com',
                'password' => bcrypt($faker->text($maxNbChars = 15))
            ]);
        }
    }
}
