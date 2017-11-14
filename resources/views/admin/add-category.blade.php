@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

        <form method="post" action="{{route('admin.postAddCategory')}}">
            <div class="form-element">
                <label for="category_name">Category name</label>
                <input type="text" name="category_name" id="category_name">
            </div>
            <div class="form-element">
                <label for="category_url">Category url</label>
                <input type="text" name="category_url" id="category_url">
            </div>
            <button type="submit" class="btn btn-primary">Add category</button>
            {{ csrf_field() }}
        </form>

@endsection