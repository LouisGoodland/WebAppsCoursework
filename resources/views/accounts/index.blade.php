@extends('layouts.posts')

@section('title')
    @if($is_viewing_new == 1)
        Viewing All Accounts
    @elseif($is_viewing_new == 2)
        Viewing New Accounts
    @else
        Viewing Friends
    @endif


@endsection

@section('content')
    <li>Logged in currently is: {{auth()->user()->account->username}}</li>
    <br>

    <form method="GET" action={{ route('discover.accounts') }} }}>
        @csrf
        <input type="submit" value="load all">
    </form>

    <form method="GET" action={{ route('discover.accounts.friends') }} }}>
        @csrf
        <input type="submit" value="load friends">
    </form>

    <form method="GET" action={{ route('discover.accounts.new') }} }}>
        @csrf
        <input type="submit" value="load new">
    </form>
    

    @foreach ($accounts as $account)
        @if(auth()->user()->account->id != $account->id)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endif
        
    @endforeach
@endsection