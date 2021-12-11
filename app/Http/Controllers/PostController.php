<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Account;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\AccountPostInteraction;

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
        $posts_to_remove = Post::all()->where('user_id', auth()->user()->account->id)
        ->pluck('id');
        $is_viewing_new = 1;
        
        return app('App\Http\Controllers\PostController')->show_all($is_viewing_new, $posts_to_remove);
    }

    public function index_new()
    {
        $is_viewing_new = 2;

        $account_friends = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)->pluck('account_id_reciever');

        $posts_to_remove = Post::all()
        ->whereIn('account_id', $account_friends)->pluck('id');

        return app('App\Http\Controllers\PostController')->show_all($is_viewing_new, $posts_to_remove);
    }

    public function index_friends()
    {
        $is_viewing_new = 3;

        $account_friends = Friendship::all()
        ->where('account_id_sender', auth()->user()->account->id)->pluck('account_id_reciever');

        $posts_to_remove = Post::all()
        ->whereNotIn('account_id', $account_friends)->pluck('id');

        return app('App\Http\Controllers\PostController')->show_all($is_viewing_new, $posts_to_remove);
    }

    public function show_all($is_viewing_new, $posts_to_remove)
    {
        $posts = Post::whereNotIn('id', $posts_to_remove)
        ->paginate(5);

        return view('posts.index', ['posts' => $posts, 
        'is_viewing_new' => $is_viewing_new,]);
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

        //change required later
        $validated_post = $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg|max:81920',
            'content' => 'required'
        ]);

        //creates a new post
        $p = new Post;

        if($request->image != null)
        {
            $newImageName = $request->image->hashName();
            $request->image->move(public_path('images'), $newImageName);
            $p->image_path = $newImageName;
        }
        
        
        $p->content = $validated_post['content'];
        $p->account_id = auth()->user()->account->id;
        $p->save();

        //makes a notification for the post produced
        Notification::factory()->createNotifications($p);

        session()->flash('message', 'uploaded');
        return redirect(route('discover.posts'));
    }

    //produces a new interaction
    public function produceInteraction(Post $post, $type)
    {
        $interaction = new AccountPostInteraction;
        $interaction->account_id = auth()->user()->account->id;
        $interaction->post_id = $post->id;
        $interaction->type = $type;
        $interaction->save();

        Notification::factory()->createInteractionNotification($interaction);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //adds a view to the post upon viewing it
        $post->views = $post->views + 1;
        $post->save();
        app('App\Http\Controllers\PostController')->produceInteraction($post, "view");
        
        return app('App\Http\Controllers\PostController')->show_part2($post);
    }

    //for when I dont want to add a view (likes / dislikes)
    public function show_part2(Post $post)
    {
        $comments_on_post = Comment::where('post_id', $post->id)->get();
        //will be used to collect information about the users
        $accounts = Account::get();

        return view('posts.show', ['post' => $post, 'comments' => $comments_on_post,
                    'accounts' => $accounts]);
    }

    public function post_attributes(Post $post)
    {
        $refreshed_post = Post::where('id', $post->id)->first();
        return [$refreshed_post->views, $refreshed_post->likes, $refreshed_post->dislikes];
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
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
                'image' => 'mimes:jpeg,bmp,png,jpg|max:81920',
                'content' => 'max:9999999999999999999999999'
            ]);
    
            if($request->content != null)
            {
                $post->content = $validated_post_change['content'];
            }
    
            if($request->image != null)
            {
                $newImageName = $request->image->hashName();
                $request->image->move(public_path('images'), $newImageName);
                $post->image_path = $newImageName;
            }

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
