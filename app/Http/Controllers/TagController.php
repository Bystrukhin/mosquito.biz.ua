<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{

    public function index(Request $request, $tag_id)
    {
        $tags = DB::table('tags')
            ->select('*')
            ->where('tags.id', '=', $tag_id)
            ->get();

        $list = DB::table('article_tag')
            ->select('*')
            ->where('article_tag.tag_id', '=', $tag_id)
            ->get();

        $categoryUrl = DB::table('categories')
            ->select('*')
            ->get();

        $articlesRaw = DB::table('articles')
            ->select('*')
            ->get();

        $articlesBuf = [];
        $articlesBuf = collect($articlesBuf);

        foreach($list as $item) {
            foreach($categoryUrl as $url) {
                foreach($articlesRaw as $value) {
                    if($value->id == $item->article_id) {
                        if($url->id == $value->category_id) {
                            $articlesBuf->push($value);
                        }
                    }
                }
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $currentPageSearchResults = $articlesBuf->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $articles = new LengthAwarePaginator($currentPageSearchResults, count($articlesBuf), $perPage, $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]);


        return view('tag', ['articles' => $articles,
            'tags' => $tags, 'list' => $list, 'categoryUrl' => $categoryUrl]);
    }

    public function search() {

        $param = Input::get('search', '');

        $tags = DB::table('tags')
            ->select('*')
            ->where('tags.name', '=', $param)
            ->get();

        $list = DB::table('article_tag')
            ->join('tags', 'article_tag.tag_id', '=', 'tags.id')
            ->where('tags.name', '=', $param)
            ->get();

        $categoryUrl = DB::table('categories')
            ->select('*')
            ->get();

        $articlesRaw = DB::table('articles')
            ->select('*')
            ->get();

        $articlesBuf = [];
        $articlesBuf = collect($articlesBuf);

        foreach($list as $item) {
            foreach($categoryUrl as $url) {
                foreach($articlesRaw as $value) {
                    if($value->id == $item->article_id) {
                        if($url->id == $value->category_id) {
                            $articlesBuf->push($value);
                        }
                    }
                }
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $currentPageSearchResults = $articlesBuf->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $articles = new LengthAwarePaginator($currentPageSearchResults, count($articlesBuf), $perPage, $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        return view('tag', ['articles' => $articles,
            'tags' => $tags, 'list' => $list, 'categoryUrl' => $categoryUrl]);
    }

    public function executeSearch() {

        $keywords = Input::get('keywords', '');

        $tags = DB::table('tags')
            ->select('*')
            ->get();

        $searchTags = [];
        $searchTags = collect($searchTags);

        foreach($tags as $tag) {
            if(Str::contains(Str::lower($tag->name), Str::lower($keywords))) {
                $searchTags->push($tag);
            }
        }

        $searchTags->toArray();

        return view('searched-tags', ['searchTags'=>$searchTags]);
    }
}
