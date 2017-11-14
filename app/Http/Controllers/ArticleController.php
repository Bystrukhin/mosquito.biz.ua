<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Article;

class ArticleController extends Controller
{
    public function index(Request $request, $category_id, $article_id)
    {
        $article = DB::table('articles')
            ->select('*')
            ->where('articles.id', '=', $article_id)
            ->get();

        $tagNames = DB::table('tags')
            ->select('*')
            ->get();

        $tags = DB::table('article_tag')
            ->select('*')
            ->get();

        $comments = DB::table('comments')
            ->select('*')
            ->where('comments.article_id', '=', $article_id)
            ->orderBy('vote', 'DESC')
            ->get();

        $users = DB::table('users')
            ->select('*')
            ->get();

        return view('article', ['article' => $article, 'tags' => $tags,
            'tagNames'=>$tagNames, 'comments' => $comments, 'users' => $users]);
    }

    public function search(Request $request)
    {
        $category = DB::table('categories')
            ->select('*')
            ->get();

        $date = Input::get('date', '');
        $categories = [];
        $categories = collect($categories);
        $inputCategories = Input::get('article_category_id');
        if(!empty($inputCategories)) {
            foreach($inputCategories as $value){
                $categories->push($value);
            }
        }
        $categories = $categories->toArray();

        $tags = [];
        $tags = collect($tags);
        $inputTags = Input::get('tags');
        if(!empty($inputTags)) {
            foreach($inputTags as $value){
                $tags->push($value);
            }
        }

//        $tags = $tags->toArray();
//
//        if ($tags) {
//            $articles = DB::table('articles')
//                ->where('articles.category_id', '=', $category_id)
//                ->where('articles.date', '>', $date)
//                ->leftJoin('article_tag', 'article_tag.article_id', '=', 'articles.id')
//                ->where('article_tag.tag_id', '=', $tags)
//                ->paginate(5);
//        } elseif (!$tags) {
//            $articles = DB::table('articles')
//                ->where('articles.category_id', '=', $category_id)
//                ->where('articles.date', '>', $date)
//                ->paginate(5);
//        }

        return view('search-article', ['articles' => $articles, 'category'=>$category]);
    }
}
