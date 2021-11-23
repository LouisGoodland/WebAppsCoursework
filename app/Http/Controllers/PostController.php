<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Account;
use App\Models\Notification;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAccount = $request->validate([
            'content' => 'required',
        ]);

        $p = new Post;
        $p->content = $validatedAccount['content'];

        //will need to update to make it use the account that is logged in
        $p->account_id = Account::all()->random()->id;
        $p->save();

        //makes a notification for the post produced
        Notification::factory()->createNotifications($p);

        session()->flash('message', 'uploaded');
        return redirect('/discover');
    }



    public function add_like($id)
    {
        $post = Post::findOrFail($id);
        $post->likes = $post->likes + 1;
        $post->save();

        return redirect()->route('specific.post', ['post' => $id]);
    }



    public function add_dislike($id)
    {
        $post = Post::findOrFail($id);
        $post->dislikes = $post->dislikes + 1;
        $post->save();
        
        return redirect()->route('specific.post', ['post' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();
        
        $comments_on_post = Comment::where('post_id', $post->id)->get();
        //will be used to collect information about the users
        $accounts = Account::get();
        return view('posts.show', ['post' => $post, 'comments' => $comments_on_post,
                    'accounts' => $accounts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
