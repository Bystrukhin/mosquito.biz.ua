<?php

use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 500; $i++) {
            DB::table('article_tag')->insert([
                'article_id' => $faker->biasedNumberBetween($min = 1, $max = 200),
                'tag_id' => $faker->biasedNumberBetween($min = 1, $max = 20),
            ]);
        }
    }
}
