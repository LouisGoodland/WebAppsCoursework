@extends('layouts.posts')

@section('title')   
    create an account:
@endsection

@section('content')
    @csrf
    <p>username: <input type="text" name="username"></p>
    <p>password: <input type="text" name="password"></p>
    <input type="submit" value="Submit">
    <input type="submit" value="New Account">
@endsection