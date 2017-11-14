@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')


        @foreach($comments as $comment)
            <br>
            @foreach($users as $user)
                @if($user->id == $comment->user_id)
                    <p>Author: <a href="{{ route('user.getComments', ['user_id' => $user->id]) }}" class="catg_title">{{$user->name}}</a></p>
                @endif
            @endforeach

                <div id="{{$comment->id}}">{{ $comment->text }}</div>
            @if($comment->Visible === 1)
                <div >Publishing status: published</div>
            @else
                <div >Publishing status: not published</div>
            @endif

            <form action="{{ route('admin.editComment', ['comment_id' => $comment->id, 'article_id'=>$article_id]) }}">
                <button class="comment-btn" type="submit">Edit Comment</button>
            </form>
            <form action="{{ route('admin.deleteComment', ['comment_id' => $comment->id, 'article_id'=>$article_id]) }}">
                <button class="comment-btn" type="submit">Delete Comment</button>
            </form>
        @endforeach

@endsection