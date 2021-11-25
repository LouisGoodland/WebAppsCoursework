@extends('layouts.posts')

@section('title')
    accounts that are new to the user
@endsection

@section('content')
    <li>Logged in currently is: {{auth()->user()->account->username}}</li>
    <br>
    @foreach ($accounts as $account)
        @if(auth()->user()->account->id != $account->id)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endif
        
    @endforeach
@endsection