@extends('adminlte::page')
@section('title', 'Mosquito Admin')
@section('content')

    @foreach($comments as $comment)
        <form method="post" action="{{route('admin.postEditComment', ['article_id'=>$article_id])}}">
            <p id="comment_id">Id: {{$comment->id}}</p>
            <div class="form-element">
                <label for="comment_text">Comment text</label>
                <textarea name="comment_text" id="comment_text" cols="30" rows="10">{{$comment->text}}</textarea>
            </div>
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Publish comment</a>
                <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                     <li><p><input @if($comment->Visible === 1) checked @endif type="radio" value="1" style="margin-right: 10px;" name="comment_visible">Published</p></li>
                     <li><p><input @if($comment->Visible === 0) checked @endif type="radio" value="0" style="margin-right: 10px;" name="comment_visible"> Not published</p></li>
                </ul>
            </div>
            <br>
            <br>
            <input type="hidden" value="{{$comment->id}}" name="comment_id" id="comment_id">
            <button type="submit" class="btn btn-primary">Apply changes</button>
            {{ csrf_field() }}
        </form>
    @endforeach

@endsection