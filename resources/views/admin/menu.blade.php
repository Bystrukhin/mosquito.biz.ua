@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')
    <ul>
        @foreach($menu as $item)
            @if($item->child)
            <li><a href="{{route('admin.subMenu', ['name'=>$item->name,'parent_id' => $item->id])}}">{{$item->name}}</a></li>
            @elseif(!$item->child)
            <li>{{$item->name}}</li>
            @endif
            <form action="{{route('admin.editMenu', ['name'=>$item->name])}}">
            <button class="comment-btn" type="submit">Edit menu item</button>
            </form>
            <form action="{{route('admin.deleteMenu', ['menu_id' => $item->id])}}">
                <button class="comment-btn" type="submit">Delete menu item</button>
            </form>
        @endforeach
        <form action="{{route('admin.addMenu')}}">
            <br>
            <button class="comment-btn" type="submit">Add new menu item</button>
        </form>
        <form action="{{route('admin.addSubMenu')}}">
            <br>
            <button class="comment-btn" type="submit">Add new sub menu item</button>
        </form>
        <form action="{{route('admin.addSubSubMenu')}}">
            <br>
            <button class="comment-btn" type="submit">Add new subSub menu item</button>
        </form>
    </ul>

@endsection