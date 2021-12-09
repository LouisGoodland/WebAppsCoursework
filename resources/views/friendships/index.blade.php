@extends('layouts.posts')

@section('title')
    Followers
@endsection

@section('content')

@section('navigation')

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#followers" aria-expanded="false" aria-controls="followers">
            Followers
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#following" aria-expanded="false" aria-controls="following">
            Following
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#friends" aria-expanded="false" aria-controls="friends">
            Friends
        </button>
    </div>

@endsection

    <h3 class="text-center">Followers:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="followers">
            <div class="card card-body">
                @foreach($followers as $account)
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
                @endforeach   
            </div>
        </div>
    </div>

    <h3 class="text-center">Following:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="following">
            <div class="card card-body">
                @foreach($following as $account)
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
                @endforeach   
            </div>
        </div>
    </div>

    <h3 class="text-center">Friends:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="friends">
            <div class="card card-body">
                @foreach ($follow_back as $account)
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
                @endforeach   
            </div>
        </div>
    </div>


@endsection