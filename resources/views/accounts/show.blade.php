@extends('layouts.posts')

@section('title')
    test
@endsection

@section('content')
    <li>{{$account->username}}</li>
    @if($account->first_name!=null)
        <li>{{$account->first_name}}</li>
    @else
        <li>no first name</li>
    @endif

    @foreach ($posts as $post)
        <li>{{$post->content}}</a></li>
    @endforeach


@endsection