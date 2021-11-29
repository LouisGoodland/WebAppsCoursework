@extends('layouts.posts')

@section('title')
    @if($is_viewing_new ?? '')
        @if($is_viewing_new == 1)
            Viewing Friends
        @else
            Viewing New Accounts
        @endif
    @else
        Viewing All Accounts
    @endif
    

@endsection

@section('content')
    <li>Logged in currently is: {{auth()->user()->account->username}}</li>
    <br>

    <form method="GET" action={{ route('discover.accounts.filtered') }} }}>
        @csrf
        <input type="checkbox"  name="following">
        <input type="checkbox"  name="not_following">
        <input type="submit" value="Submit">
    </form>
    

    @foreach ($accounts as $account)
        @if(auth()->user()->account->id != $account->id)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endif
        
    @endforeach
@endsection