@extends('layouts.master')

@section('content')
    <div class="category_page_content">
        <div class="single_category_content">

            @foreach($category as $value)
            <h2><span>{{$value->name}}</span></h2>
                <ul class="spost_nav">
                    @foreach($articles as $article)
                        <li>
                            <div class="media wow fadeInDown">
                                <div class="media-body"> <a href="{{ route('article.index', ['category_id' => $value->url, '$article_id' => $article->id]) }}" class="catg_title" name="{{$article->id}}"> {{ $article->title }}</a> </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
    {{ $articles }}
@endsection