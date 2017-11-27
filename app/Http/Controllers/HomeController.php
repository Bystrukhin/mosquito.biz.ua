<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = DB::table('articles')
            ->orderBy('date', 'DESC')
            ->take(5)
            ->get();

        $topArticles = DB::table('articles')
            ->leftJoin('comments', 'articles.id', '=', 'comments.article_id')
            ->groupBy('articles.id')
            ->orderBy('comments_count','desc')
            ->selectRaw('articles.*, count(comments.article_id) as comments_count')
            ->where('comments.date', '>', \Carbon\Carbon::now()->subMonth())
            ->take(4)
            ->get();

        $activeUsers = DB::table('users')
            ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
            ->groupBy('users.id')
            ->orderBy('comments_count','desc')
            ->selectRaw('users.*, count(comments.user_id) as comments_count')
            ->take(5)
            ->get();

        $categories = DB::table('categories')
            ->select('*')
            ->get();

        $articlesRaw = DB::table('articles')
            ->select('*')
            ->orderBy('date', 'desc')
            ->get();

        $articles = collect($articlesRaw)->groupBy('category_id');

        $articles->toArray();

        return view('home', ['slider' => $slider, 'topArticles' => $topArticles,
            'activeUsers' => $activeUsers, 'categories' => $categories,
            'articles' => $articles]);
    }

    public function getContacts()
    {
        return view('contacts');
    }

    public function getAbout()
    {
        return view('about');
    }
}
