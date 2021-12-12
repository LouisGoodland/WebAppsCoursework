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

    <div class="col">
        @if(Route::currentRouteName()=="notifications")
            @if(auth()->user()->account->is_admin)
                <form method="GET" action={{ route('admin.notifications') }} }}>
                    @csrf
                    <input type="submit" value="Admin Notifications" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
                </form>
            @endif
        @else
            <form method="GET" action={{ route("notifications") }} }}>
                @csrf
                <input type="submit" value="Notifications" class="btn btn-dark btn-lg w-100 p-2 border border-dark">
            </form>
        @endif
    </div>

@endsection

    <h3 class="text-center">Posts:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="posts">
            <div class="card card-body">
                @foreach ($post_notifications as $post_notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$post_notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $post_notification->notifiable->id]) }}>
                                <p>
                                    <input type="submit" value="New post by: {{$post_notification->notifiable->account->username}}">
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
                @foreach ($friendship_notifications as $friendship_notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$friendship_notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.account', ['account' => $friendship_notification->notifiable->account->id]) }}>
                                <p>
                                    <input type="submit" value="Followed by: {{$friendship_notification->notifiable->account->username}}">
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
                @foreach ($comment_notifications as $comment_notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$comment_notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $comment_notification->notifiable->post->id]) }}>
                                <p>
                                    <input type="submit" value="Comment by: {{$comment_notification->notifiable->account->username}}">
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
                @foreach ($interaction_notifications as $interaction_notification)

                    <div class="row">
                        <div class="col-4">
                            @if(Route::currentRouteName()=="admin.notifications")
                                <p>Notification for: {{$interaction_notification->account->username}}</p>
                            @endif
                        </div>

                        <div class="col-8">
                            <a href={{ route('specific.post', ['post' => $interaction_notification->notifiable->account->id]) }}>
                                <p>
                                    <input type="submit" value="{{$interaction_notification->notifiable->type}} By: {{$interaction_notification->notifiable->account->username}}">
                                </p>
                            </a>    
                        </div>
                    </div>

                @endforeach  
            </div>
        </div>
    </div>

@endsection