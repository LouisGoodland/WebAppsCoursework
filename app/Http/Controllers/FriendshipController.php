<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Friendship;
use App\Models\Notification;

use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friend_array = app('App\Http\Controllers\FriendshipController')->get_friendship_data();
        
        return view('friendships.index', 
        ["following" => $friend_array[0],
        "followers" => $friend_array[1],
        "follow_back" => $friend_array[2]]);
        
    }

    public function index_following()
    {
        $friend_array = app('App\Http\Controllers\FriendshipController')->get_friendship_data();
        return view('friendships.index', 
        ["following" => $friend_array[0]]);
    }

    public function index_followers()
    {
        $friend_array = app('App\Http\Controllers\FriendshipController')->get_friendship_data();
        return view('friendships.index',
        ["followers" => $friend_array[1]]);
    }

    public function index_follow_back()
    {
        $friend_array = app('App\Http\Controllers\FriendshipController')->get_friendship_data();
        return view('friendships.index',
        ["follow_back" => $friend_array[2]]);
    }

    public function get_friendship_data()
    {
        //list of every account the user follows
        $account_friends = Friendship::all()
        ->where("account_id_sender", auth()->user()->account->id);
        
        //list of every account who follows the user
        $accounts_who_follow = Friendship::all()
        ->where("account_id_reciever", auth()->user()->account->id);

        //list of every friend and user who follow each other back
        $friendships = Friendship::all()
        ->whereIn('account_id_sender', $account_friends->pluck("account_id_reciever"))
        ->where("account_id_reciever", '=', auth()->user()->account->id);
        
        return [$account_friends, $accounts_who_follow, $friendships];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Account $account)
    {
        //adds the friendship to the account
        $f = new Friendship;
        $f->account_id_sender = auth()->user()->account->id;
        $f->account_id_reciever = $account->id;
        $f->save();

        //makes a notification for the post produced
        Notification::factory()->createNotifications($f);

        session()->flash('message', 'added a friend');
        return redirect( route('discover.accounts') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //Need to implement here
        //convert account to friendship
        $friendship_to_destroy_search = 
        Friendship::where('account_id_sender', auth()->user()->account->id)
        ->where('account_id_reciever', $account->id)->first();

        if($friendship_to_destroy_search != null)
        {
            $friendship_to_destroy = Friendship::findOrFail($friendship_to_destroy_search->id);
            $friendship_to_destroy->delete();
        }
        else 
        {
            dd("there has been an error");
        }

        return redirect( route('discover.accounts') );

    }
}
