@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')
    <ul>
        @foreach($tags as $tag)
            <li id="{{$tag->id}}">{{$tag->name}}</li>
            <form action="{{route('admin.deleteTag', ['tag' => $tag->id])}}">
                <button class="comment-btn" type="submit">Delete Tag</button>
            </form>
        @endforeach
        <form action="{{route('admin.addTag')}}">
            <br>
            <button class="comment-btn" type="submit">Add New Tag</button>
        </form>
    </ul>

@endsection