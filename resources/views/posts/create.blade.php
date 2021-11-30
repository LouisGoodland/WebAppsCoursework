@extends('layouts.posts')

@section('title')   
    creating a post
@endsection

@section('content')
    <form method="POST" action={{ route('store.post') }} enctype="multipart/form-data">
        @csrf
        <input type="file"  name="image">
        <p>Post content: <input type="text" name="content"></p>
        <input type="submit" value="Submit">
    </form>
@endsection