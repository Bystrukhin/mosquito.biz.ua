@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    @foreach($articles as $article)
        <form method="post" action="{{route('admin.postEditArticle')}}" enctype="multipart/form-data">
            <div class="form-element">
                <label for="article_image">Image</label>
                <input type="hidden" name="article_old_image" id="article_old_image" value="{{$article->image}}">
                <input type="file" name="article_image" id="article_image">
            </div>
            <br>
            <div class="form-element">
                <label for="article_title">Article title</label>
                <input type="text" name="article_title" id="article_title" value="{{$article->title}}">
            </div>
            <br>
            <br>
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Article category</a>
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                    @foreach($categories as $category)
                        @if ($category->id == $article->category_id)
                            <li><p><input checked="checked" type="radio" value="{{$category->id}}" style="margin-right: 10px;" name="article_category_id"> {{$category->name}}</p></li>
                        @elseif ($category->id !== $article->category_id)
                            <li><p><input type="radio" value="{{$category->id}}" style="margin-right: 10px;" name="article_category_id"> {{$category->name}}</p></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <br>
            <br>
            <div class="form-element">
                <label for="article_author">Article author</label>
                <input type="text" name="article_author" id="article_author" value="{{$article->author}}">
            </div>
            <br>
            <div class="form-element">
                <label for="article_content">Article text</label>
                <textarea rows="10" cols="45" name="article_content" id="article_content">{{$article->content}}</textarea>
            </div>
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Delete current and select new tags</a>
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                        @foreach($tags as $tag)
                            <li><p><input @if($checked->contains($tag->id)) checked @endif type="checkbox" value="{{$tag->id}}" style="margin-right: 10px;" name="tags[]">{{$tag->name}}</p></li>
                        @endforeach
                </ul>
            </div>
            <br>
            <br>
            <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
            <button type="submit" class="btn btn-primary">Apply changes</button>
            {{ csrf_field() }}
        </form>
    @endforeach

@endsection