@extends('layouts.posts')

@section('title')   
    create an account:
@endsection

@section('content')
    <form method="POST" action="{{ route('account.store') }}">
    <p>username: <input type="text" name="username"></p>
    <p>password: <input type="text" name="password"></p>
    <input type="submit" value="create">
@endsection