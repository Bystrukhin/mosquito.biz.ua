@extends('layouts.master')

@section('content')
    <div class="category_page_content">
        <div class="single_category_content">
            @foreach($user as $item)
                    <h2><span>{{$item->name}}</span></h2>
            @endforeach
            <ul class="spost_nav">
                @foreach($comments as $value)
                    <li>
                        <div class="media wow fadeInDown">
                            <div class="media-body">
                                <span>{{ $value->text }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{ $comments->links() }}
@endsection