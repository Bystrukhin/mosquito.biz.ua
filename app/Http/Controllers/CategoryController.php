<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category_id)
    {

        $category = DB::table('categories')
            ->where('categories.url', '=', $category_id)
            ->get();
        $cat_id = '';

        foreach($category as $item) {
            $cat_id = $item->id;
        }

        $articles = DB::table('articles')
            ->where('articles.category_id', '=', $cat_id)
            ->paginate(5);

        return view('category', ['articles' => $articles, 'category' => $category, 'cat_id' => $cat_id]);
    }
}
