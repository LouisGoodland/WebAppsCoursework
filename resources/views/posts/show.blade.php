@extends('layouts.posts')

@section('title')
    specific post
@endsection

@section('content')
    <li>{{$accounts->where('id', $post->account_id)->first()->username}} posted:</li>
    <li>{{$post->content}}</li>
    <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>

    <form method="POST" action={{ route('post.add_like', ['post' => $post->id]) }}>
        @csrf
        <input type="submit" value="like">
    </form>
    
    <form method="POST" action={{ route('post.add_dislike', ['post' => $post->id]) }}>
        @csrf
        <input type="submit" value="dislike">
    </form>

    @foreach ($comments as $comment)
        <li>{{$accounts->where('id', $comment->account_id)->first()->username}} commented:</a></li>
        <li>{{$comment->content}}</li>
        <br>
    @endforeach
    
    <li><a href={{ route('discover.posts') }}>Back</a></li>
@endsection