@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="widget-area no-padding blank">
                <div class="status-upload">
                    <form action="{{route('user.postComment')}}">
                        @foreach($category as $cat)
                            <input type="hidden" name="category" id="category" value="{{$cat->id}}">
                        @endforeach
                        @foreach($article as $item)
                            <input type="hidden" name="article" id="article" value="{{$item->id}}">
                        @endforeach
                        <textarea placeholder="Share your thoughts!" name="comment" id="comment"></textarea>
                        <ul>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
                            <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                        </ul>
                        <button type="submit" class="default-btn"><i class="fa fa-share"></i> Share</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection