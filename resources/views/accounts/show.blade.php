@extends('layouts.posts')

@section('title')
    {{$account->username}}
@endsection

@section('content')

@section('navigation')
    <div class="col">
        @if($followed_by_user == false)
            <form method="POST" action={{ route('add.friend', ['account' => $account]) }}>
                @csrf
                <input type="submit" value="Follow" class="btn btn-light btn-lg w-100 p-2 border border-dark">
            </form>
        @else
            <form method="POST" action={{ route('delete.friend', ['account' => $account]) }}>
                @csrf
                <input type="submit" value="Following" class="btn btn-success btn-lg w-100 p-2 border border-dark">
            </form>
        @endif
    </div>

    <div class="col">
        @if($follows_user == true)
            <form method="POST" action={{ route('removing.follow', ['account' => $account]) }}>
                @csrf
                <input type="submit" value="Remove as Follower" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
            </form>
        @else
            <input type="submit" value="Doesn't follow you" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
        @endif
    </div>


    @if (auth()->user()->account->is_admin)
        <div class="col">
            <form method="POST" action={{ route('admin.delete.account', ['account' => $account]) }}>
                @csrf
                <input type="submit" value="Destroy user as admin!" class="btn btn-danger btn-lg w-100 p-2 border border-dark">
            </form>
        </div>
    @endif
@endsection


    <div class="row">
        <div class="col-4 border border-dark">
            @if ($account->image_path != null)
                <img src="{{ asset('profile_pictures/'.$account->image_path) }}" class="img-thumbnail"/>
            @else
                <img src="{{ asset('profile_pictures/K2Tcw7yRPoCblm8z5kKrRIugqjOuXM5EWvxqP5AO.png') }}" class="img-thumbnail"/>
            @endif
        </div>
        <div class="col-6 border border-dark">
            <div class="row">
                <br>
            </div>
            <div class="row">
                <p>Username: {{$account->username}}</p>
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                @if($account->first_name!=null)
                    <p>First name: {{$account->first_name}}</p>
                @else
                    <p>No First name</p>
                @endif
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                @if($account->last_name!=null)
                    <p>Last name: {{$account->last_name}}</p>
                @else
                    <p>No Last name</p>
                @endif
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                <p>Amount of posts: {{$posts->count()}}</p>
            </div>
        </div>
    </div>
    
    <br>
    @foreach ($posts as $post)
        <li><a href={{ route('specific.post', ['post' => $post->id]) }}>{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach
    

@endsection