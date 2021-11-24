@extends('layouts.posts')

@section('title')
    all accounts
@endsection

@section('content')
    <li>Logged in currently is: {{auth()->user()->account->username}}</li>
    <br>
    @foreach ($accounts as $account)
        <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>{{$account->username}}</a></li>
    @endforeach
    <a href="/create_account">Create an account (temp)</a>
@endsection