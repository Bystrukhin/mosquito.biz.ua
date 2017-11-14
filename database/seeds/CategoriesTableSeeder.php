<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category([
            'name' => 'Politics',
            'url' => 'politics',
        ]);
        $category->save();

        $category = new \App\Category([
            'name' => 'Economy',
            'url' => 'economy',
        ]);
        $category->save();

        $category = new \App\Category([
            'name' => 'Sport',
            'url' => 'sport',
        ]);
        $category->save();

        $category = new \App\Category([
            'name' => 'Technology',
            'url' => 'technology',
        ]);
        $category->save();

        $category = new \App\Category([
            'name' => 'Health',
            'url' => 'health',
        ]);
        $category->save();

        $category = new \App\Category([
            'name' => 'Fashion',
            'url' => 'fashion',
        ]);
        $category->save();
    }
}
