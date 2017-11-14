<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
            DB::table('tags')->insert([
                'name' => $faker->unique($min = 5)->word,
                'date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
            ]);
        }
    }
}
