@extends('layouts.posts')

@section('title')   
    all notifications
@endsection

@section('content')
    @foreach ($notifications as $notification)
        <li>{{$notification->notification_text}}</li>
        @if($notification->notifiable != null)
            @if(get_class($notification->notifiable) == "App\Models\Friendship")
                <li><a href={{ route('specific.account', ['account' => 
                $accounts->where('id', 
                    $friendships->where('id',
                        $notification->notifiable_id)
                        ->first()
                    ->account_id_sender)
                ->first()])}}>
                Click here to view</a></li>

            @else

                @if(get_class($notification->notifiable) == "App\Models\Post")
                    <li><a href={{ route('specific.post', ['post' =>
                    $posts->where('id', 
                        $notification->notifiable_id)
                        ->first()
                    ->first()])}}>
                    View post</a></li>

                @elseif(get_class($notification->notifiable) == "App\Models\Comment")
                    <li><a href={{ route('specific.post', ['post' =>
                    $posts->where('id',
                        $comments->where('id',
                            $notification->notifiable_id)
                            ->first()
                        ->post_id)
                    ->first()])}}>
                    View posts</a></li>
                
                @elseif(get_class($notification->notifiable) == "App\Models\AccountPostInteraction")
                    <li><a href={{ route('specific.post', ['post' =>
                    $posts->where('id',
                        $account_post_interactions->where('id',
                            $notification->notifiable_id)
                            ->first()
                        ->post_id)
                    ->first()])}}>
                    View</a></li>

                @endif
                

            @endif


        @endif
        
        <br>
    @endforeach
@endsection