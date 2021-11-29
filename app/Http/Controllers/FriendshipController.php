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
        //
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
