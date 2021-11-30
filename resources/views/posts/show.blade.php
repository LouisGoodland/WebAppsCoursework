@extends('layouts.posts')

@section('title')
    specific post
@endsection

@section('content')
    <li>{{$accounts->where('id', $post->account_id)->first()->username}} posted:</li>
    <li>{{$post->content}}</li>
    <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>

    @if(auth()->user()->account->id != $post->account_id)
        <form method="POST" action={{ route('post.add_like', ['post' => $post->id]) }}>
            @csrf
            <input type="submit" value="like">
        </form>
        
        <form method="POST" action={{ route('post.add_dislike', ['post' => $post->id]) }}>
            @csrf
            <input type="submit" value="dislike">
        </form>
    @endif

    @if ($post->image_path != null)
        <img src="{{ asset('images/'.$post->image_path) }}"/>
        
    @endif

    @foreach ($comments as $comment)
        <li>{{$accounts->where('id', $comment->account_id)->first()->username}} commented:</a></li>
        <li>{{$comment->content}}</li>
        <br>
    @endforeach

    @if (auth()->user()->account->is_admin)
        <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
            @csrf
            <input type="submit" value="Silence as admin!">
        </form>
    @elseif (auth()->user()->account->id == $post->account_id)
        <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
            @csrf
            <input type="submit" value="Delete post">
        </form>
    @endif


    <li><a href={{ route('discover.posts') }}>Back</a></li>
@endsection