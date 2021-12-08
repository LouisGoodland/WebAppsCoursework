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
                <input type="submit" value="Friends Only" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="Friends Only" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>

    <div class="col">
        <form method="GET" action={{ route('discover.accounts.new') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.accounts.new")
                <input type="submit" value="New Accounts Only" class="btn btn-dark btn-lg w-100 p-2">
            @else
                <input type="submit" value="New Accounts Only" class="btn btn-light btn-lg w-100 p-2">
             @endif  
        </form>
    </div>
@endsection

    @foreach ($accounts as $account)
        @if(auth()->user()->account->id != $account->id)
            
            <div class="row border border-dark bg-secondary bg-opacity-25">
                <div class="col-2">
                    @if ($account->image_path != null)
                        <img src="{{ asset('profile_pictures/'.$account->image_path) }}" class="img-thumbnail"/>
                    @else
                        <img src="{{ asset('profile_pictures/K2Tcw7yRPoCblm8z5kKrRIugqjOuXM5EWvxqP5AO.png') }}" class="img-thumbnail"/>
                    @endif
                </div>
                <div class="col-8">
                    <div class="row-2">
                        <a href={{ route('specific.account', ['account' => $account->id]) }}>
                            <p class="text-center fw-normal">
                                <input type="submit" value="{{$account->username}}">
                            </p>
                        </a>
                    </div>  
                    <div class="row">
                        <div class="col">
                            <p class="text-center">First name:</p>
                            @if($account->first_name!=null)
                                <p class="text-center">{{$account->first_name}}</p>
                            @else
                                <p class="text-center">No first name</p>
                            @endif
                        </div>
                        <div class="col">
                            <p class="text-center">Last name:</p>
                            @if($account->last_name!=null)
                                <p class="text-center">{{$account->last_name}}</p>
                            @else
                                <p class="text-center">No last name</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <br>
    @endforeach
@endsection