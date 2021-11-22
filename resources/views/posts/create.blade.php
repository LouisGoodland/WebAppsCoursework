@extends('layouts.posts')

@section('title')   
    creating a post
@endsection

@section('content')
    <form method="POST" action="/discover">
        @csrf
        <p>Post content: <input type="text" name="content"></p>
        <input type="submit" value="Submit">
    </form>
@endsection