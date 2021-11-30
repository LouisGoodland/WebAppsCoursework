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
        $accounts_to_remove = Account::all()->where('id', auth()->user()->account->id)
        ->pluck('id');
        $is_viewing_new = 1;
        
        return app('App\Http\Controllers\AccountController')->show_all($is_viewing_new, $accounts_to_remove);
    }

    public function index_new()
    {
        $is_viewing_new = 2;
        $accounts_to_remove = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)->pluck('account_id_reciever');

        return app('App\Http\Controllers\AccountController')->show_all($is_viewing_new, $accounts_to_remove);
    }

    public function index_friends()
    {
        $is_viewing_new = 3;
        $temp = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)->pluck('account_id_reciever');
        //gets a list of accounts that the user doesn't follow
        $accounts_to_remove = Account::all()
        ->whereNotIn('id', $temp)->pluck('id');

        return app('App\Http\Controllers\AccountController')->show_all($is_viewing_new, $accounts_to_remove);
    }

    public function show_all($is_viewing_new, $accounts_to_remove)
    {
        $accounts = Account::all()
        ->whereNotIn('id', auth()->user()->account->id)
        ->whereNotIn('id', $accounts_to_remove);

        return view('accounts.index', ['accounts' => $accounts, 
        'is_viewing_new' => $is_viewing_new]);
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
        $followed_by_user = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)
        ->where('account_id_reciever', $account->id)->count()>0;

        $follows_user = Friendship::all()
        ->where('account_id_sender', $account->id)
        ->where('account_id_reciever', auth()->user()->account->id)->count()>0;

        //gets all of the posts the account being viewed has done
        $posts_by_account = Post::where('account_id', $account->id)->get();

        //returns the view
        return view('accounts.show', ['account' => $account, 'posts' => $posts_by_account,
        'followed_by_user' => $followed_by_user, 'follows_user' => $follows_user]);
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
        auth()->user()->account->save();
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
        if(auth()->user()->account->is_admin)
        {
            $account->user->delete();
        }
        return redirect(route('discover.accounts'));
    }
}
