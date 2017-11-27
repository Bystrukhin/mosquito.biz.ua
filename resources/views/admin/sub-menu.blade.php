@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')
    <ul>
        @foreach($subMenu as $item)
            @if($item->child)
            <li><a href="{{route('admin.subSubMenu', ['name'=>$name, 'subName'=>$item->name, 'grandparent_id'=>$parent_id, 'parent_id' => $item->id])}}" id="{{$item->id}}">{{$item->name}}</a></li>
            @elseif(!$item->child)
            <li id="{{$item->id}}">{{$item->name}}</li>
            @endif
            <form action="{{route('admin.editSubMenu', ['name'=>$name,'subName'=>$item->name])}}">
                <button class="comment-btn" type="submit">Edit menu item</button>
            </form>
            <form action="{{route('admin.deleteSubMenu', ['name'=>$name,'subName' => $item->name, 'parent_id'=>$parent_id, 'subMenu_id' => $item->id])}}">
                <button class="comment-btn" type="submit">Delete sub menu item</button>
            </form>
        @endforeach
    </ul>

@endsection