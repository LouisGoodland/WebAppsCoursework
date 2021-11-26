<?php

namespace App\Http\Controllers;

use App\Models\Account;

use App\Models\Post;
use App\Models\Friendship;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //Gets a list of accounts that can't have a request sent to
        $accounts_already_friends_with = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)->pluck('account_id_reciever');

        //gets a list of all users who aren't friends with the sender
        $accounts = Account::all()->whereNotIn('id', $accounts_already_friends_with);

        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_account = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|email',
        ]);

        $a = new Account;
        $a->username = $validated_account['username'];
        $a->password = $validated_account['password'];
        $a->email = $validated_account['email'];

        //need to add some validation to make sure its unique

        $a->save();

        session()->flash('message', 'made an account');
        return redirect(route('discover.accounts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        
        //used to determine if the logged in user is friends with the account
        $is_friends_with_user = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)
        ->where('account_id_reciever', $account->id)->count()>0;

        //gets all of the posts the account being viewed has done
        $posts_by_account = Post::where('account_id', $account->id)->get();

        //returns the view
        return view('accounts.show', ['account' => $account, 'posts' => $posts_by_account,
        'is_friends_with_user' => $is_friends_with_user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('accounts.edit');
    }

    public function revealIfAdmin()
    {
        return view('accounts.not_an_admin');
    }


    /**
     * function for making someone an admin
     */

    public function makeAdmin()
    {
        auth()->user()->account->is_admin = true;
        return redirect(route('discover.accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validates the input data
        $validated_account_changes = $request->validate([
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'date_of_birth' => 'date',
        ]);

        //adds the changes to the accounts
        $a = auth()->user()->account;
        $a->first_name = $validated_account_changes['first_name'];
        $a->last_name = $validated_account_changes['last_name'];
        $a->date_of_birth = $validated_account_changes['date_of_birth'];
        $a->save();

        return redirect(route('discover.accounts'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
