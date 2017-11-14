@extends('layouts.master')

@section('content')
    <div class="category_page_content">
        <div class="single_category_content">
            @foreach($tags as $tag)
             <h2><span>{{$tag->name}}</span></h2>
            @endforeach
                <ul class="spost_nav">
                    @foreach($list as $item)
                        @foreach($categoryUrl as $url)
                            @foreach($articles as $value)
                                @if($value->id == $item->article_id)
                                    @if($url->id == $value->category_id)
                                        <li>
                                            <div class="media wow fadeInDown">
                                                <div class="media-body"> <a href="{{ route('article.index',
                                                ['category_id' => $url->url, '$article_id' => $value->id]) }}"
                                                     class="catg_title" name="{{$value->id}}">{{ $value->title }}</a> </div>
                                            </div>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </ul>
        </div>
    </div>
    {{ $articles->appends(Illuminate\Support\Facades\Input::except('page'))->render() }}
@endsection