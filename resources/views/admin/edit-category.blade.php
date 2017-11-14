@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

        @foreach($categories as $category)
            <form method="post" action="{{route('admin.postEditCategory')}}">
                <div class="form-element">
                    <label for="category_name">Category name</label>
                    <input type="text" name="category_name" id="category_name" value="{{$category->name}}">
                </div>
                <div class="form-element">
                    <label for="category_url">Category url</label>
                    <input type="text" name="category_url" id="category_url" value="{{$category->url}}">
                </div>
                <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}">
                <button type="submit" class="btn btn-primary">Apply changes</button>
                {{ csrf_field() }}
            </form>
        @endforeach

@endsection