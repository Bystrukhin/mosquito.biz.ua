<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Article;
use Illuminate\Support\Facades\Auth;
use App\Comments;
use function Sodium\increment;

class ArticleController extends Controller
{
    public function index(Request $request, $category_id, $article_id)
    {
        if (Session::get('id') !== $article_id) {
            DB::table('articles')
                ->where('articles.id', '=', $article_id)
                ->increment('views');
            Session::put('id', $article_id);
        }

        $article = DB::table('articles')
            ->select('*')
            ->where('articles.id', '=', $article_id)
            ->get();

        $tagNames = DB::table('tags')
            ->select('*')
            ->get();

        $article_tags = DB::table('article_tag')
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

        return view('article', ['article' => $article, 'article_tags' => $article_tags,
            'tagNames'=>$tagNames, 'comments' => $comments, 'users' => $users]);
    }

    public function search(Request $request)
    {
        $category = DB::table('categories')
            ->select('*')
            ->get();

        $date = Input::get('date', '');
        $inputCategories = Input::get('article_category_id');
        $inputTags = Input::get('tags');

        if($request->has('article_category_id')){
            if ($request->has('tags')) {
                $articles = DB::table('articles')
                    ->leftJoin('article_tag', 'articles.id', '=', 'article_tag.article_id')
                    ->select('articles.*')
                    ->whereIn('articles.category_id', $inputCategories)
                    ->where('articles.date', '>', $date)
                    ->whereIn('article_tag.tag_id', $inputTags)
                    ->paginate(5);
            } elseif (!$request->has('tags')) {
                $articles = DB::table('articles')
                    ->select('articles.*')
                    ->whereIn('articles.category_id', $inputCategories)
                    ->where('articles.date', '>', $date)
                    ->paginate(5);
            }
        } elseif (!$request->has('article_category_id')) {
            $articles = DB::table('articles')
                ->leftJoin('article_tag', 'articles.id', '=', 'article_tag.article_id')
                ->select('articles.*')
                ->where('articles.date', '>', $date)
                ->whereIn('article_tag.tag_id', $inputTags)
                ->paginate(5);
        }

        return view('search-article', ['articles' => $articles, 'category'=>$category]);
    }

    public function like() {
        $comment = $_GET['id'];
        $user = Auth::user();
        $type = 'comment';
        $date = date("Y-m-d H:i:s");

        $likes = DB::table('likeable_likes')
            ->where('likeable_likes.likable_id', '=', $comment)
            ->where('likeable_likes.user_id', '=', $user->id)
            ->get();

        if(!$likes->first()){
            DB::table('likeable_likes')
                ->insert(['likable_id' => $comment, 'user_id' => $user->id,
                    'likable_type' => $type, 'date'=>$date]);
            DB::table('comments')
                ->where('comments.id', '=', $comment)
                ->increment('vote');
        }



        $response = array(
            'status' => 'success',
            'msg'    => 'Like saved successfully',
        );

        return \Response::json($response);
    }

    public function dislike(Comments $comment) {
        $comment = $_GET['id'];
        $user = Auth::user();

        DB::table('likeable_likes')
            ->where('likeable_likes.likable_id', '=', $comment)
            ->where('likeable_likes.user_id', '=', $user->id)
            ->delete();

        DB::table('comments')
            ->where('comments.id', '=', $comment)
            ->decrement('vote');

        $response = array(
            'status' => 'success',
            'msg'    => 'Dislike saved successfully',
        );

        return \Response::json($response);
    }

}
