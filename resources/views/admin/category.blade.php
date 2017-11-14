@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

            <ul>
                @foreach($articles as $article)
                    <li class="category_item">
                        <p>Id: {{$article->id}}</p>
                        <a href="#" name="{{$article->id}}">Title: {{ $article->title }}</a>
                    </li>
                    <form action="{{route('admin.editArticle', ['article_id' => $article->id])}}">
                        <button class="comment-btn" type="submit">Edit Article</button>
                    </form>
                    <form action="{{route('admin.deleteArticle', ['article_id' => $article->id, 'category_id'=>$article->category_id])}}">
                        <button class="comment-btn" type="submit">Delete Article</button>
                    </form>
                    <form action="{{route('admin.comments',  $article->id)}}">
                        <button class="comment-btn" type="submit">Get comments</button>
                    </form>
                @endforeach
            </ul>

    {{ $articles }}
@endsection