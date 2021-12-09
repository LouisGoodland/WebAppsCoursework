@extends('layouts.posts')

@section('title')   
    New Post
@endsection

@section('content')
    <form method="POST" action={{ route('store.post') }} enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" class="position-relative top-50 start-50 translate-middle">
        <br>
        <br>
        <br>
        <input type="text" name="content" class="position-relative top-50 start-50 translate-middle">
        <br>
        <br>
        <input type="submit" value="Submit" class="position-relative top-50 start-50 translate-middle">
    </form>
@endsection