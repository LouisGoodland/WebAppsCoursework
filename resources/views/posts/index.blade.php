@extends('layouts.posts')

@section('title')   
    @if($is_viewing_new == 1)
        Viewing All Posts
    @elseif($is_viewing_new == 2)
        Viewing Posts From New Accounts
    @else
        Viewing Friends Posts
    @endif
@endsection

@section('content')

@section('navigation')
    <div class="col">
        <form method="GET" action={{ route('discover.posts.friends') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.posts.friends")
                <input type="submit" value="Friends Only" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
            @else
                <input type="submit" value="Friends Only" class="btn btn-light btn-lg w-100 p-2 border border-dark">
             @endif  
        </form>
    </div>

    <div class="col">
        <form method="GET" action={{ route('discover.posts.new') }} }}>
            @csrf
            @if(Route::currentRouteName()=="discover.posts.new")
                <input type="submit" value="New Accounts Only" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
            @else
                <input type="submit" value="New Accounts Only" class="btn btn-light btn-lg w-100 p-2 border border-dark">
             @endif  
        </form>
    </div>
@endsection

    @foreach ($posts as $post)
        <div class="row border border-dark bg-secondary bg-opacity-25">
            <div class="row">
                <a href={{ route('specific.post', ['post' => $post->id]) }}>
                    <p class="text-center fw-normal">
                        <input type="submit" value="{{$post->account->username}}">
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