@extends('layouts.posts')

@section('title')
    all accounts
@endsection

@section('content')
    @foreach ($accounts as $account)
        <li>Username: <a href="/discover_accounts/{{$account->id}}">{{$account->username}}</a></li>
    @endforeach
@endsection