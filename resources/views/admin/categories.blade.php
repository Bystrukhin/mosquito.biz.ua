@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')
    <ul>
        @foreach($categories as $category)
            <li><a href="{{route('admin.getCategory', ['category_id' => $category->id])}}">{{$category->name}}</a></li>
            <form action="{{route('admin.editCategory', ['category_id' => $category->id])}}">
                <button class="comment-btn" type="submit">Edit {{$category->name}} Category</button>
            </form>
        @endforeach
            <form action="{{route('admin.addCategory')}}">
                <br>
                <button class="comment-btn" type="submit">Add New Category</button>
            </form>
            <form action="{{route('admin.addArticle')}}">
                <br>
                <button class="comment-btn" type="submit">Add New Article</button>
            </form>
    </ul>

@endsection