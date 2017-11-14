@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    <form method="post" action="{{route('admin.postAddTag')}}">
        <div class="form-element">
            <label for="tag_name">Tag name</label>
            <input type="text" name="tag_name" id="tag_name">
        </div>
        <button type="submit" class="btn btn-primary">Add tag</button>
        {{ csrf_field() }}
    </form>

@endsection