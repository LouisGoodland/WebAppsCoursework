@extends('layouts.posts')

@section('title')
    1 account
@endsection

@section('content')
    <li>Username: {{$account->username}}</li>

    @if($account->first_name!=null)
        <li>First name: {{$account->first_name}}</li>
    @else
        <li>No First name</li>
    @endif

    @if($account->last_name!=null)
        <li>Last name: {{$account->last_name}}</li>
    @else
        <li>No Last name</li>
    @endif
    <li>Amount of posts: {{$posts->count()}}</li>

    @if($is_friends_with_user == false)
        <form method="POST" action={{ route('add.friend', ['account' => $account]) }}>
            @csrf
            <input type="submit" value="Add as friend">
        </form>
    @endif

    @if (auth()->user()->account->is_admin)
        <form method="POST" action={{ route('admin.delete.account', ['account' => $account]) }}>
            @csrf
            <input type="submit" value="Destroy user as admin!">
        </form>
    @endif
    
    
    <br>
    @foreach ($posts as $post)
        <li><a href={{ route('specific.post', ['post' => $post->id]) }}>{{$post->id}}</a></li>
        <li>{{$post->content}}</li>
        <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>
        <br>
    @endforeach
    

@endsection