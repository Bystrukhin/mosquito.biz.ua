@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    <form method="post" action="{{route('admin.postAddSubSubMenu')}}">
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
        <br>
        <br>
        <div class="btn-group">
            <a href="#" class="btn btn-primary">Grandparent name</a>
            <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
            <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                @foreach($menu as $item)
                    <li><p><input type="radio" value="{{$item->id}}" style="margin-right: 10px;" name="top_name"> {{$item->name}}</p></li>
                @endforeach
            </ul>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="btn-group">
            <a href="#" class="btn btn-primary">Parent name</a>
            <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
            <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                @foreach($subMenu as $item)
                    <li><p><input type="radio" value="{{$item->id}}" style="margin-right: 10px;" name="mid_name"> {{$item->name}}</p></li>
                @endforeach
            </ul>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Add menu item</button>
        {{ csrf_field() }}
    </form>

@endsection