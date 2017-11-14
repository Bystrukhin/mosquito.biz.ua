<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 3000; $i++) {
            DB::table('comments')->insert([
                'article_id' => $faker->biasedNumberBetween($min = 1, $max = 200),
                'user_id' => $faker->biasedNumberBetween($min = 1, $max = 20),
                'text' => $faker->sentence($nbWords = 20, $variableNbWords = true),
                'date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
                'vote' => $faker->biasedNumberBetween($min = 1, $max = 10)
            ]);
        }
    }
}
