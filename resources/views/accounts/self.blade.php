@extends('layouts.posts')

@section('title')
    {{auth()->user()->account->username}}
@endsection

@section('content')

    @if (auth()->user()->account->image_path != null)
        <img src="{{ asset('profile_pictures/'.auth()->user()->account->image_path) }}"/>
    @endif

    @if(auth()->user()->account->first_name!=null)
        <li>First name: {{auth()->user()->account->first_name}}</li>
    @else
        <li>No First name</li>
    @endif

    @if(auth()->user()->account->last_name!=null)
        <li>Last name: {{auth()->user()->account->last_name}}</li>
    @else
        <li>No Last name</li>
    @endif
    <li>Amount of posts: {{$posts->count()}}</li>


    <form method="GET" action={{ route('notifications') }}>
        @csrf
        <input type="submit" value="load notifications">
    </form>

    <form method="GET" action={{ route('activity') }}>
        @csrf
        <input type="submit" value="activity">
    </form>

    <form method="GET" action={{ route('edit.account') }}>
        @csrf
        <input type="submit" value="edit account">
    </form>

    <br>
    @foreach ($posts as $post)
        <li><a href={{ route('specific.post', ['post' => $post->id]) }}>{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach
@endsection