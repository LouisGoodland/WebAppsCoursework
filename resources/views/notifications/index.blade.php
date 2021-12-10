@extends('layouts.posts')

@section('title')   
    Notifications
@endsection

@section('content')

@section('navigation')
    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#posts" aria-expanded="false" aria-controls="followers">
            Posts
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#follows" aria-expanded="false" aria-controls="followers">
            Followings
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#comments" aria-expanded="false" aria-controls="followers">
            Comments
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#interactions" aria-expanded="false" aria-controls="followers">
            Interactions
        </button>
    </div>

@endsection

    <h3 class="text-center">Posts:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="posts">
            <div class="card card-body">
                @foreach ($notifications_post as $notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $notification->notifiable->id]) }}>
                                <p>
                                    <input type="submit" value="New post by: {{$notification->notifiable->account->username}}">
                                </p>
                            </a>    
                        </div>
                    </div>

                @endforeach  
            </div>
        </div>
    </div>

    <h3 class="text-center">Follows:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="follows">
            <div class="card card-body">
                @foreach ($notifications_friendship as $notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.account', ['account' => $notification->notifiable->account->id]) }}>
                                <p>
                                    <input type="submit" value="Followed by: {{$notification->notifiable->account->username}}">
                                </p>
                            </a>  
                        </div>
                    </div>

                @endforeach  
            </div>
        </div>
    </div>

    <h3 class="text-center">Comments:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="comments">
            <div class="card card-body">
                @foreach ($notifications_comment as $notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $notification->notifiable->post->id]) }}>
                                <p>
                                    <input type="submit" value="Comment by: {{$notification->notifiable->account->username}}">
                                </p>
                            </a>    
                        </div>
                    </div>

                @endforeach  
            </div>
        </div>
    </div>

    <h3 class="text-center">Interactions:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="interactions">
            <div class="card card-body">
                @foreach ($notifications_interaction as $notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $notification->notifiable->account->id]) }}>
                                <p>
                                    <input type="submit" value="{{$notification->notifiable->type}} By: {{$notification->notifiable->account->username}}">
                                </p>
                            </a>    
                        </div>
                    </div>

                @endforeach  
            </div>
        </div>
    </div>

@endsection