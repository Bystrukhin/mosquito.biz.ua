@extends('layouts.master')

@section('content')
<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                @foreach($slider as $item)
                <div class="single_iteam">
                    <a href="{{ route('article.index', ['category_id' => $item->category_id, '$article_id' => $item->id]) }}">
                        <img src="{{$item->image}}" alt="">
                    </a>
                    <div class="slider_article">
                        <h2>
                            <a class="slider_tittle" href="#">{{$item->title}}</a>
                        </h2>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="latest_post">
                <h2><span>Popular articles</span></h2>
                <ul class="spost_nav">
                    @foreach($topArticles as $article)
                    <li>
                        <div class="media wow fadeInDown">
                            <a href="#" class="media-left">
                                <img alt="" src="{{$article->image}}">
                            </a>
                            <div class="media-body">
                                <a href="{{ route('article.index', ['category_id' => $item->category_id, '$article_id' => $item->id]) }}" class="catg_title" name="{{$article->id}}"> {{$article->title}}</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="contentSection">
    <div class="categories">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="home_page_content">
                @foreach($categories as $category)
                <div class="category_content">
                    <h2><a href="{{ route('category.index', ['category_id' => $category->url]) }}" name="{{$category->url}}"><span>{{$category->name}}</span></a></h2>
                    <ul class="spost_nav">
                            @foreach($articles as $key=>$article)
                                @if($key == $category->id)
                                    @foreach($article->take(5) as $item)
                            <li>
                                <div class="media wow fadeInDown">
                                    <div class="media-body"> <a href="{{ route('article.index', ['category_id' => $category->url, '$article_id' => $item->id]) }}" class="catg_title" name="{{$item->id}}"> {{$item->title}}</a> </div>
                                </div>
                            </li>
                                    @endforeach
                                @endif
                            @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="active_users">
            <h2><span>Most active users</span></h2>
            <ul class="spost_nav">
                @foreach($activeUsers as $user)
                    <li>
                        <div class="media wow fadeInDown">
                            <div class="media-body"> <a href="{{ route('user.getComments', ['user_id' => $user->id]) }}" class="catg_title" name="{{$user->id}}"> {{$user->name}}</a> </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection