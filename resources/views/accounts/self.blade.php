@extends('layouts.posts')

@section('title')
    {{auth()->user()->account->username}}
@endsection

@section('content')


@section('navigation')

    <form method="GET" action={{ route('activity') }} }}>
        @csrf
        <input type="submit" value="Friends Only" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
    </form>

    <form method="GET" action={{ route('edit.account') }} }}>
        @csrf
        <input type="submit" value="Friends Only" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
    </form>
    

@endsection

    <div class="row">
        <div class="col-5 border border-dark">
            @if (auth()->user()->account->image_path != null)
                <img src="{{ asset('profile_pictures/'.auth()->user()->account->image_path) }}" class="img-thumbnail"/>
            @else
                <img src="{{ asset('profile_pictures/K2Tcw7yRPoCblm8z5kKrRIugqjOuXM5EWvxqP5AO.png') }}" class="img-thumbnail"/>
            @endif
        </div>
        <div class="col-5 border border-dark">
            <div class="row">
                <br>
            </div>
            <div class="row">
                <p>Username: {{auth()->user()->account->username}}</p>
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                @if(auth()->user()->account->first_name!=null)
                    <p>First name: {{auth()->user()->account->first_name}}</p>
                @else
                    <p>No First name</p>
                @endif
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                @if(auth()->user()->account->last_name!=null)
                    <p>Last name: {{auth()->user()->account->last_name}}</p>
                @else
                    <p>No Last name</p>
                @endif
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                @if(auth()->user()->account->date_of_birth!=null)
                    <p>DOB: {{auth()->user()->account->date_of_birth}}</p>
                @else
                    <p>No date of birth given</p>
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
        <div class="row border border-dark bg-secondary bg-opacity-25">
            <div class="row">
                <a href={{ route('specific.post', ['post' => $post->id]) }}>
                    <p class="text-center fw-normal">
                        <input type="submit" value="View Post">
                    </p>
                </a>
            </div>
            <div class="row">
                <p>{{$post->content}}</p>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center">Views: {{$post->views}}</p>
                </div>  
                <div class="col">
                    <p class="text-center">Likes: {{$post->likes}}</p>
                </div>  
                <div class="col">
                    <p class="text-center">Dislikes: {{$post->dislikes}}</p>
                </div>  
                <div class="col">
                    @if ($post->image_path != null)
                        <p class="text-center">Has an Image?: Yes</p>
                    @else
                        <p class="text-center">Has an Image?: No</p>
                    @endif
                </div>  
            </div>
        </div>
        <br>
    @endforeach

    

@endsection