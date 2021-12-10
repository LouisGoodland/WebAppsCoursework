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
            $notifications_post = Notification::all()
            ->where('notifiable_type', "App\Models\Post");
            //dd($notifications_post);

            $notifications_friendship = Notification::all()
            ->where('notifiable_type', "App\Models\Friendship");
            

            $notifications_comment = Notification::all()
            ->where('notifiable_type', "App\Models\Comment");

            $notifications_interaction = Notification::all()
            ->where('notifiable_type', "App\Models\AccountPostInteraction");
            
            return view('notifications.index', 
            ['notifications_post' => $notifications_post,
            'notifications_friendship' => $notifications_friendship,
            'notifications_comment' => $notifications_comment,
            'notifications_interaction' => $notifications_interaction]);

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
        $notifications_post = Notification::all()
        ->where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Post");;

        $notifications_friendship = Notification::all()
        ->where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Friendship");

        $notifications_comment = Notification::all()
        ->where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\Comment");

        $notifications_interaction = Notification::all()
        ->where('account_id', auth()->user()->account->id)
        ->where('notifiable_type', "App\Models\AccountPostInteraction");
        
        return view('notifications.index', 
        ['notifications_post' => $notifications_post,
        'notifications_friendship' => $notifications_friendship,
        'notifications_comment' => $notifications_comment,
        'notifications_interaction' => $notifications_interaction]);
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
