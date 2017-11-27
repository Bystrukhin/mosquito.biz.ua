@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    @foreach($menu as $item)
        <form method="post" action="{{route('admin.postEditSubSubMenu', ['name'=>$name,'subName'=>$subName, 'subSubName'=>$item->name])}}">
            <div class="form-element">
                <label for="menu_name">Menu item name</label>
                <input type="text" name="menu_name" id="menu_name" value="{{$item->name}}">
            </div>
            <div class="form-element">
                <label for="menu_url">Menu url</label>
                <input type="text" name="menu_url" id="menu_url" value="{{$item->url}}">
            </div>
            <div class="form-element">
                <label for="menu_visibility">Menu visibility</label>
                <input type="text" name="menu_visibility" id="menu_visibility" value="{{$item->visible}}">
            </div>
            <input type="hidden" name="menu_id" id="menu_id" value="{{$item->id}}">
            <button type="submit" class="btn btn-primary">Apply changes</button>
            {{ csrf_field() }}
        </form>
    @endforeach

@endsection