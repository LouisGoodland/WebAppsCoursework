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

@section('navigation')
    <div class="col">
        <form method="GET" action={{ route('discover.posts.friends') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.posts.friends")
                <input type="submit" value="load friends" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="load friends" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>

    <div class="col">
        <form method="GET" action={{ route('discover.posts.new') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.posts.new")
                <input type="submit" value="load new" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="load new" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>
@endsection

    @foreach ($posts as $post)
        <br>
        <li><a href={{ route('specific.post', ['post' => $post->id]) }}>{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach


@endsection