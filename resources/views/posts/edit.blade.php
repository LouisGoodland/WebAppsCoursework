@extends('layouts.posts')

@section('title')
    edit post
@endsection

@section('content')
    <form method="POST" action={{ route('update.post', ['post' => $post]) }}>
        @csrf
        <p>Content: <input type="text" name="content"
        value="{{ old('content') }}"></p>
        <input type="submit" value="Submit">
    </form>
@endsection