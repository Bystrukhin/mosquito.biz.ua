@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    <form method="post" action="{{route('admin.postAddMenu')}}">
        <div class="form-element">
            <label for="menu_name">Menu name</label>
            <input type="text" name="menu_name" id="menu_name">
        </div>
        <div class="form-element">
            <label for="menu_url">Menu url</label>
            <input type="text" name="menu_url" id="menu_url">
        </div>
        <div class="form-element">
            <label for="menu_visibility">Menu visibility</label>
            <input type="text" name="menu_visibility" id="menu_visibility" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Add menu item</button>
        {{ csrf_field() }}
    </form>

@endsection