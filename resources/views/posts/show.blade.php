@extends('layouts.posts')

@section('title')
    specific post
@endsection

@section('content')
    <li><a href="/discover/{{$post->id}}">{{$post->id}}</a></li>
    <li>{{$post->content}}</li>
    <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
@endsection