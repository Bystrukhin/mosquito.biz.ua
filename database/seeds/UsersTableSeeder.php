<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => $faker->password(),
                'date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
            ]);
        }
    }
}
