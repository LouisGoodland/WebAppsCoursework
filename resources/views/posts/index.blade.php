@extends('layouts.posts')

@section('title')   
    @if($is_viewing_new == 1)
        Viewing All Posts
    @elseif($is_viewing_new == 2)
        Viewing Posts From New Accounts
    @else
        Viewing Friends Posts
    @endif
@endsection

@section('content')

    <form method="GET" action={{ route('discover.posts') }} }}>
        @csrf
        <input type="submit" value="load all">
    </form>

    <form method="GET" action={{ route('discover.posts.friends') }} }}>
        @csrf
        <input type="submit" value="load friends">
    </form>

    <form method="GET" action={{ route('discover.posts.new') }} }}>
        @csrf
        <input type="submit" value="load new">
    </form>

    @foreach ($posts as $post)
        <br>
        <li><a href={{ route('specific.post', ['post' => $post->id]) }}>{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach

@endsection