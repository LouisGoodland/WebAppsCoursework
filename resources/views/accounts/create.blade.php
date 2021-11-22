@extends('layouts.posts')

@section('title')   
    create an account:
@endsection

@section('content')
    <form method="POST" action="/discover_accounts">
        @csrf
        <p>username: <input type="text" name="username"></p>
        <p>password: <input type="text" name="password"></p>
        <p>email address: <input type="text" name="email"></p>
        <input type="submit" value="Submit">
    </form>
@endsection