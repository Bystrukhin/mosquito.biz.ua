@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')
    <ul>
        @foreach($subSubMenu as $item)
            <li>{{$item->name}}</li>
            <form action="{{route('admin.editSubSubMenu', ['subSubName'=>$item->name, 'name'=>$name, 'subName'=>$subName])}}">
                <button class="comment-btn" type="submit">Edit menu item</button>
            </form>
            <form action="{{route('admin.deleteSubSubMenu', ['name'=>$name, 'subName'=>$subName, 'grandparent_id'=>$grandparent_id, 'parent_id'=>$parent_id, 'subSubName'=>$item->name, 'subSubMenu_id' => $item->id])}}">
                <button class="comment-btn" type="submit">Delete sub menu item</button>
            </form>
        @endforeach
    </ul>

@endsection