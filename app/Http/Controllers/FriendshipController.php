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
        $account_friends_ids = Friendship::all()
        ->where("account_id_sender", auth()->user()->account->id)
        ->pluck("account_id_reciever");
        $account_friends = Account::all()
        ->whereIn("id", $account_friends_ids);
        
        //list of every account who follows the user
        $accounts_who_follow_ids = Friendship::all()
        ->where("account_id_reciever", auth()->user()->account->id)
        ->pluck("account_id_sender");
        $accounts_who_follow = Account::all()
        ->whereIn("id", $accounts_who_follow_ids);

        //list of every friend and user who follow each other back
        $friendships_ids = Friendship::all()
        ->whereIn('account_id_sender', $account_friends_ids)
        ->where("account_id_reciever", '=', auth()->user()->account->id)
        ->pluck("account_id_sender");
        $friendships = Account::all()
        ->whereIn("id", $friendships_ids);
        
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
        return redirect(route('specific.account', ["account" => $account]));
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
    public function destroy(Account $account, $sender, $reciever)
    {
        
        $friendship_to_destroy_search = Friendship::all()
        ->where('account_id_sender', $sender)
        ->where('account_id_reciever', $reciever)->first();

        if($friendship_to_destroy_search != null)
        {
            $friendship_to_destroy = Friendship::findOrFail($friendship_to_destroy_search->id);
            $friendship_to_destroy->delete();
        }
        else 
        {
            dd("there has been an error");
        }

        return redirect(route('specific.account', ["account" => $account]));
    }

    public function remove_follow(Account $account)
    {
        $sender = $account->id;
        $reciever = auth()->user()->account->id;
        return app('App\Http\Controllers\FriendshipController')->destroy($account, $sender, $reciever);
        
    }

    public function stop_follow(Account $account)
    {
        $sender = auth()->user()->account->id;
        $reciever = $account->id;
        return app('App\Http\Controllers\FriendshipController')->destroy($account, $sender, $reciever);
    }
}
