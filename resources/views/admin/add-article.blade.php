@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

        <form method="post" action="{{route('admin.postAddArticle')}}" enctype="multipart/form-data">
            <div class="form-element">
                <label for="article_image">Image:</label>
                <input type="file" name="article_image" id="article_image">
            </div>
            <br>
            <br>
            <div class="form-element">
                <label for="article_title">Article title</label>
                <input type="text" name="article_title" id="article_title">
            </div>
            <br>
            <br>
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Categories</a>
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                    @foreach($categories as $category)
                        <li><p><input type="radio" value="{{$category->id}}" style="margin-right: 10px;" name="category"> {{$category->name}}</p></li>
                    @endforeach
                </ul>
            </div>
            <br>
            <br>
            <div class="form-element">
                <label for="article_author">Article author</label>
                <input type="text" name="article_author" id="article_author" >
            </div>
            <br>
            <br>
            <div class="form-element">
                <label for="article_content">Article text</label>
                <textarea rows="10" cols="45" name="article_content" id="article_content"></textarea>
            </div>
            <br>
            <br>
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Tags</a>
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                    @foreach($tags as $tag)
                        <li><p><input type="checkbox" value="{{$tag->id}}" style="margin-right: 10px;" name="tags[]">{{$tag->name}}</p></li>
                    @endforeach
                </ul>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Add article</button>
            {{ csrf_field() }}
        </form>


@endsection