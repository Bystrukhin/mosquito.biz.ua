@extends('layouts.master')

@section('content')
    <div class="article_container">
        <div class="single_article">
            <ul class="spost_nav">
                @foreach($article as $item)
                <li>
                    <div class="media wow fadeInDown">
                        <img src="../../{{ $item->image }}" alt="">
                        <h2 class="article-title">{{ $item->title }}</h2>
                        <p class="article-content">{{ $item->content }}</p>
                        <span class="article-author">{{ $item->author }}</span>
                        <span class="article-date">{{ $item->date }}</span>
                        <span class="article-views">Total views: {{ $item->views }}</span>
                    </div>
                </li>
                    <div>
                        <h3>Tags:</h3>
                        @foreach($article_tags as $tag)
                            @if($tag->article_id == $item->id)
                                @foreach($tagNames as $tagName)
                                    @if($tagName->id == $tag->tag_id)
                                        <span class="tag-name"> <a href="{{ route('tag.index', ['tag_id' => $tagName->id]) }}" name="{{$tagName->id}}">{{$tagName->name}}</a> </span>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <h3>Comments:</h3>
                        <form class="nav navbar-nav navbar-right" action="{{route('user.getCommentPage', ['category_id' => $item->category_id,'article_id'=>$item->id])}}">
                                <button class="comment-btn" type="submit">Add your comment</button>
                        </form>
                        @foreach($comments as $comment)
                            <br>
                            @if($comment->Visible !== 0)
                            @foreach($users as $user)
                                @if($user->id == $comment->user_id)
                                        <a href="{{ route('user.getComments', ['user_id' => $user->id]) }}" class="catg_title">{{$user->name}}:</a>
                                        <br>
                                @endif
                            @endforeach
                            <span id="{{$comment->id}}">{{$comment->text}}</span>
                            <br>
                            <form class="nav navbar-nav navbar-right" action="{{route('comment.like')}}">
                                <input type="hidden" name="comment_id" id="comment_id" value="{{$comment->id}}">
                                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                <a href="#" class="like" role="button" onclick="like()" data-link="{{ asset('like') }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Like</a>
                            </form>
                            <form class="nav navbar-nav navbar-right" action="{{route('comment.dislike')}}">
                                <input type="hidden" name="comment_id" id="comment_id" value="{{$comment->id}}">
                                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                <a href="#" class="dislike" role="button" onclick="dislike()" data-link="{{ asset('dislike') }}"><i class="fa fa-thumbs-down" aria-hidden="true"></i>Dislike</a>
                            </form>
                            <br>
                            <br>

                            @endif
                        @endforeach
                        <script>
                            function like () {
                                var url = '{{ asset('like') }}';
                                var id = $('#comment_id').val();
                                $.ajax({
                                    type: 'get',
                                    data: {id: id},
                                    url: url,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                                    },
                                    success: function(response) {
                                        console.log('success: '+response);
                                    },
                                    error: function(response) {
                                        var errors = response.responseJSON;
                                        console.log(errors);
                                    }
                                });
                                }
                            function dislike() {
                                var url = '{{ asset('dislike') }}';
                                var id = $('#comment_id').val();
                                $.ajax({
                                    type: 'get',
                                    data: {id: id},
                                    url: url,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                                    },
                                    success: function(response) {
                                        console.log('success: '+response);
                                    },
                                    error: function(response) {
                                        var errors = response.responseJSON;
                                        console.log(errors);
                                    }
                                })
                            }
                        </script>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>

@endsection