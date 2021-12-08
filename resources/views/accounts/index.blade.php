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

@section('navigation')
    <div class="col">
        <form method="GET" action={{ route('discover.accounts.friends') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.accounts.friends")
                <input type="submit" value="load friends" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="load friends" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>

    <div class="col">
        <form method="GET" action={{ route('discover.accounts.new') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.accounts.new")
                <input type="submit" value="load new" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="load new" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>
@endsection
        

    @foreach ($accounts as $account)
        @if(auth()->user()->account->id != $account->id)
            <li>Username: <a href={{ route('specific.account', ['account' => $account->id]) }}>
            {{$account->username}}</a></li>
        @endif
        
    @endforeach
@endsection