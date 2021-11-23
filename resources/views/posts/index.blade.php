@extends('layouts.posts')

@section('title')   
    all posts
@endsection

@section('content')
    @foreach ($posts as $post)
        <br>
        <li><a href="/discover/{{$post->id}}">{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach
    
@endsection