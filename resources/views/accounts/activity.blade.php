@extends('layouts.posts')

@section('title')
    Activity
@endsection

@section('content')
    
    <h3>views</h3>
    @foreach($views as $view)
        <li><a href={{ route('specific.post', ['post' =>
            $posts->where('id', $view->post_id)->first()])}}>
            View {{$view->id}}</a></li>
    @endforeach    

    <h3>Likes</h3>
    @foreach($likes as $like)
        <li><a href={{ route('specific.post', ['post' =>
            $posts->where('id', $view->post_id)->first()])}}>
            {{$like->id}}</a></li>
    @endforeach
         
    <h3>Dislikes</h3>
    @foreach($dislikes as $dislike)
        <li><a href={{ route('specific.post', ['post' =>
            $posts->where('id', $view->post_id)->first()])}}>
            {{$dislike->id}}</a></li>
    @endforeach

@endsection