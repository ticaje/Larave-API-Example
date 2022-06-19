@extends('layouts.app')
@section('title')
    @if($post)
        {{ $post->title }}
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
@endsection
@section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
@endsection
@section('content')
    @if($post)
        <div>
            {!! $post->content !!}
        </div>
        @if(!Auth::guest())
        <div class="panel-body">
            <form method="post" action="/comment/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="slug" value="{{ $post->slug }}">
                <div class="form-group">
                    <textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
                </div>
                <input type="submit" name='post_comment' class="btn btn-success" value="Post"/>
            </form>
            <div>
                <h3>Leave a comment</h3>
            </div>
        </div>
        @else
        <div>
            <h3><a href="{{ url('/login') }}">Login to comment</a></h3>
        </div>
        @endif
        <div>
            @if($comments)
            <span>Comments</span>
            <ul style="list-style: none; padding: 0">
                @foreach($comments as $comment)
                <li class="panel-body">
                    <div class="list-group">
                        <div class="list-group-item">
                            <h3>by {{ $comment->author->name }}</h3>
                            <p>on {{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                        </div>
                        <div class="list-group-item">
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            {!! $comments->render() !!}
            @endif
        </div>
    @else
        404 error
    @endif
@endsection
