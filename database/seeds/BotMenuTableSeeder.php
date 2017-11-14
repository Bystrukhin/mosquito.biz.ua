<?php

use Illuminate\Database\Seeder;

class BotMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bot_menu')->insert([
            'top_id' => '2',
            'mid_id' => '5',
            'order' => '1',
            'name' => 'Health',
            'url' => 'health',
        ]);

        DB::table('bot_menu')->insert([
            'top_id' => '2',
            'mid_id' => '5',
            'order' => '2',
            'name' => 'Fashion',
            'url' => 'fashion',
        ]);
    }
}
