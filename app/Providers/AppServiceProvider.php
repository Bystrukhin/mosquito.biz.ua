<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $top_menu = DB::table('top_menu')
            ->orderBy('order', 'ASC')
            ->get();

        $mid_menu = DB::table('mid_menu')
            ->orderBy('order', 'ASC')
            ->get();

        $bot_menu = DB::table('bot_menu')
            ->orderBy('order', 'ASC')
            ->get();

        $categories = DB::table('categories')
            ->select('*')
            ->get();

        $tags = DB::table('tags')
            ->select('*')
            ->get();

        $color = DB::table('color')
            ->select('*')
            ->get();

        if (!isset($_SESSION['colorName'])) {
            $_SESSION['colorName'] = 'white';
            $colorName = $_SESSION['colorName'];
        } else {
            $colorName = $_SESSION['colorName'];
        }

        view()->share(['top_menu' => $top_menu, 'mid_menu' =>$mid_menu, 'bot_menu' =>$bot_menu,
            'tags'=>$tags, 'categories'=>$categories, 'color'=>$color, 'colorName'=>$colorName]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
