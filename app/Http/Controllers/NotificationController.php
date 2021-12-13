<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\AccountPostInteraction;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->account->is_admin)
        {
            $post_notifications = 
            app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Post", 0);

            $friendship_notifications = 
            app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Friendship", 0);

            $comment_notifications = 
            app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Comment", 0);

            $interaction_notifications = 
            app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\AccountPostInteraction", 0);
            
            return view('notifications.index', 
            ['post_notifications' => $post_notifications,
            'friendship_notifications' => $friendship_notifications,
            'comment_notifications' => $comment_notifications,
            'interaction_notifications' => $interaction_notifications]);

        } 
        else
        {
            return redirect(route('admin.is_not_a'));
        }
    }

    public function getNotifications($notifiable_type, $reading)
    {

        $notifications = Notification::all()->
        where('notifiable_type', $notifiable_type)->reverse()
        ->where('has_been_read', 0);

        if($reading)
        {
            $notifications = $notifications->where('account_id', auth()->user()->account->id);
            app('App\Http\Controllers\NotificationController')->read($notifications);
        }
        
        return $notifications;

    }

    public function read($notifications)
    {
        foreach($notifications as $notification){
            $notification->has_been_read = 1;
            $notification->save();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {

        $post_notifications = 
        app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Post", 1);

        $friendship_notifications = 
        app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Friendship", 1);

        $comment_notifications = 
        app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\Comment", 1);

        $interaction_notifications = 
        app('App\Http\Controllers\NotificationController')-> getNotifications("App\Models\AccountPostInteraction", 1);
        
        return view('notifications.index', 
        ['post_notifications' => $post_notifications,
        'friendship_notifications' => $friendship_notifications,
        'comment_notifications' => $comment_notifications,
        'interaction_notifications' => $interaction_notifications]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
