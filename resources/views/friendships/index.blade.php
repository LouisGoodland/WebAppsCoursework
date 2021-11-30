@extends('layouts.posts')

@section('title')
    TITLE
@endsection

@section('content')

    <form method="GET" action={{ route('friends') }} }}>
        @csrf
        <input type="submit" value="All">
    </form>

    <form method="GET" action={{ route('friends.following') }} }}>
        @csrf
        <input type="submit" value="Followers">
    </form>

    <form method="GET" action={{ route('friends.followers') }} }}>
        @csrf
        <input type="submit" value="Following">
    </form>

    <form method="GET" action={{ route('friends.follow_back') }} }}>
        @csrf
        <input type="submit" value="Follow Back">
    </form>

    @if($following ?? "")
        <h3> Accounts the user is following </h3>
        @foreach ($following as $account)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endforeach
    @endif

    @if($followers ?? "")
        <h3> Accounts following the user </h3>
        @foreach ($followers as $account)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endforeach
    @endif

    @if($follow_back ?? "")
        <h3> Friends </h3>
        @foreach ($follow_back as $account)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endforeach
    @endif
    
@endsection