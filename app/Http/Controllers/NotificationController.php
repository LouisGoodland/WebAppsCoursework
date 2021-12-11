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
            $post_notifications = Notification::all()->
            where('notifiable_type', "App\Models\Post")->reverse();
    
            $friendship_notifications = Notification::all()->
            where('notifiable_type', "App\Models\Friendship")->reverse();
    
            $comment_notifications = Notification::all()->
            where('notifiable_type', "App\Models\Comment")->reverse();
    
            $interaction_notifications = Notification::all()->
            where('notifiable_type', "App\Models\AccountPostInteraction")->reverse();
            
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $post_notifications = Notification::all()->
        where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Post")->reverse();

        $friendship_notifications = Notification::all()->
        where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Friendship");

        $comment_notifications = Notification::all()->
        where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Comment");

        $interaction_notifications = Notification::all()->
        where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\AccountPostInteraction");
        
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
