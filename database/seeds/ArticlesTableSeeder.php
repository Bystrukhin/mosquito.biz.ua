<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 200; $i++) {
            DB::table('articles')->insert([
                'category_id' => $faker->biasedNumberBetween($min = 1, $max = 6),
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'content' => $faker->text($maxNbChars = 200),
                'image' => '/resources/views/images/img1.jpg',
                'author' => $faker->name,
                'views' => $faker->biasedNumberBetween($min = 1, $max = 500),
                'date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
            ]);
        }
    }
}
