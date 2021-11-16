@extends('layouts.posts')

@section('title')
    specific post
@endsection

@section('content')
    <li>{{$accounts->where('id', $post->account_id)->first()->username}} posted:</li>
    <li>{{$post->content}}</li>
    <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
    <br>

    @foreach ($comments as $comment)
        <li>{{$accounts->where('id', $comment->account_id)->first()->username}} commented:</a></li>
        <li>{{$comment->content}}</li>
        <br>
    @endforeach
@endsection