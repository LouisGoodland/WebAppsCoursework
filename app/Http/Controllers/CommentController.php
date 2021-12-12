<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Notification;

use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        
        $verified_data = $request->validate([
            'content' => 'required',
        ]);

        $a = new Comment;
        $a->account_id = auth()->user()->account->id;
        $a->post_id = $post->id;
        $a->content = $request['content'];

        $a->save();
        return $a;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function api_show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id);

        return [$comments->pluck("content")];
    }

    public function api_store(Post $post, Request $request)
    {
        $verified_data = $request->validate([
            'content' => 'required',
        ]);

        //makes a new comment
        $a = new Comment;
        $a->account_id = auth()->user()->account->id;
        $a->post_id = $post->id;
        $a->content = $verified_data['content'];
        $a->save();

        Notification::factory()->createCommentNotification($produced_comment);

        return [$a->pluck("content")]
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
    public function destroy($id)
    {
        //
    }
}
