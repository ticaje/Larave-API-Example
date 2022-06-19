@extends('layouts.app')
@section('title')
    <h3>{{$title}}</h3>
@endsection
@section('content')
    @if ( !$posts->count())
        <div class="list-group-item">
            <h3><span>There are no post till now.</span></h3>
        </div>
    @else
        @foreach( $posts as $post )
        <div class="list-group">
            <div class="list-group-item">
                <h4><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                    @if($post->is_published == '1')
                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                    @else
                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
                    @endif
                    @endif
                </h4>
                @php $commentsCount = $post->comments->count(); @endphp
                <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} by <a href="{{ url('/user/'.$post->author_id . '/posts')}}">{{ $post->author->name }}</a></p>
                <p>{{ $commentsCount }} Comment{{ $commentsCount != 1 ? 's' : ''}}</p>
            </div>
            <div class="list-group-item">
                <article>
                    {!! Str::limit($post->content, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                </article>
            </div>
        </div>
        @endforeach
        {!! $posts->render() !!}
    @endif
    @if (Auth::guest())
        <div>
            <h4>Login and write a new post now!!!</h4>
        </div>
    @endif
@endsection
