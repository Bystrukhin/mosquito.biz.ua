<?php

use Illuminate\Database\Seeder;

class TopMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('top_menu')->insert([
            'order' => '1',
            'name' => 'Home',
            'url' => ''
        ]);

        DB::table('top_menu')->insert([
            'order' => '2',
            'name' => 'Categories',
            'url' => '',
        ]);

        DB::table('top_menu')->insert([
            'order' => '3',
            'name' => 'About us',
            'url' => 'about',
        ]);

        DB::table('top_menu')->insert([
            'order' => '4',
            'name' => 'Contacts',
            'url' => 'contacts',
        ]);
    }
}
