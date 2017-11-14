<?php

use Illuminate\Database\Seeder;

class MidMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mid_menu')->insert([
            'top_id' => '2',
            'order' => '1',
            'name' => 'Politics',
            'url' => 'politics',
        ]);

        DB::table('mid_menu')->insert([
            'top_id' => '2',
            'order' => '2',
            'name' => 'Economy',
            'url' => 'economy',
        ]);

        DB::table('mid_menu')->insert([
            'top_id' => '2',
            'order' => '3',
            'name' => 'Technology',
            'url' => 'technology',
        ]);

        DB::table('mid_menu')->insert([
            'top_id' => '2',
            'order' => '4',
            'name' => 'Sport',
            'url' => 'sport',
        ]);

        DB::table('mid_menu')->insert([
            'top_id' => '2',
            'order' => '5',
            'name' => 'Lifestyle',
            'url' => '',
        ]);
    }
}
