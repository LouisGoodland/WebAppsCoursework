@extends('layouts.posts')

@section('title')
    You aren't an admin! haha
@endsection

@section('content')
    <form method="POST" action={{ route('admin.make') }}>
        @csrf
        <input type="submit" value="Make me admin!">
    </form>
@endsection