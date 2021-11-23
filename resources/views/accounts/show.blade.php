@extends('layouts.posts')

@section('title')
    1 account
@endsection

@section('content')
    <li>Username: {{$account->username}}</li>

    @if($account->first_name!=null)
        <li>First name: {{$account->first_name}}</li>
    @else
        <li>No First name</li>
    @endif

    @if($account->last_name!=null)
        <li>Last name: {{$account->last_name}}</li>
    @else
        <li>No Last name</li>
    @endif
    <li>Amount of posts: {{$posts->count()}}</li>

    <br>
    @foreach ($posts as $post)
        <li><a href="/discover/{{$post->id}}">{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach
    

@endsection