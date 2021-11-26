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
        $validated_post = $request->validate([
            'content' => 'required',
        ]);

        //creates a new post
        $p = new Post;
        $p->content = $validated_post['content'];

        //will need to update to make it use the account that is logged in
        $p->account_id = auth()->user()->account->id;
        $p->save();

        //makes a notification for the post produced
        Notification::factory()->createNotifications($p);

        session()->flash('message', 'uploaded');
        return redirect(route('discover.posts'));
    }



    public function add_like(Post $post)
    {
        $post->likes = $post->likes + 1;
        $post->save();

        return redirect()->route('specific.post', ['post' => $post]);
    }



    public function add_dislike(Post $post)
    {
        $post->dislikes = $post->dislikes + 1;
        $post->save();
        
        return redirect()->route('specific.post', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

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
        //Need to do some authorisation here
        if(auth()->user()->account->id == $post->account_id)
        {
            return view('posts.edit', ['post' => $post]);
        }
        else
        {
            return redirect(route('discover.posts'));
        }
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
        if(auth()->user()->account->id == $post->account_id)
        {
            $validated_post_change = $request->validate([
                'content' => 'required',
            ]);
            
            $post->content = $validated_post_change['content'];
            $post->save();
        }
        return redirect(route('discover.posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //deletes the post if its the users post or they are an admin
        if(auth()->user()->account->id == $post->account_id)
        {
            $post->delete();
        }
        elseif(auth()->user()->account->is_admin)
        {
            
            //produce an additional notification for the user
            $n = new Notification;
            $n->notifiable_id = $post->id;
            $n->notifiable_type = get_class($post);
            $n->account_id = $post->account_id;
            $n->notification_text = "An Admin Deleted your post:".$post->id;
            $n->save();

            $post->delete();
            
        }
        return redirect(route('discover.posts'));
    }
}
