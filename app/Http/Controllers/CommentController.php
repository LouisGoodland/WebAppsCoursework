<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Account;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\AccountPostInteraction;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function api_show(Post $post)
    {
        $comments = Comment::with('Account')->where('post_id', $post->id)
        ->get()->reverse();
        return $comments;

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

        Notification::factory()->createCommentNotification($a);
        
        $comments = Comment::with('Account')->where('post_id', $post->id)
        ->get()->reverse();
        return $comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
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
