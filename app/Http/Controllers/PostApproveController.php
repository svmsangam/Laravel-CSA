<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\postApproveNotification;
use App\Notifications\postDeleteNotification;
use App\Notifications\commentApproveNotification;
use App\Notifications\commentDeleteNotification;

class PostApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.mainpage');
    }
    public function showPost()
    {
        $posts =  Posts::all()->where('isApproved',0);
        return view('dashboard.pendingposts',compact('posts'));
    }
    public function showComment()
    {
        $comments = Comment::all()->where('reported','!=',0);
        return view('dashboard.reportedcomments',compact('comments'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function approvePost($id, Posts $post)
    {
        //
        $values = array('isApproved'=>1,'created_at'=>Carbon::now());
        $post = Posts::where('id',$id)->update($values);
        $post = Posts::findOrFail($id);
        $post->update($values);
        $userId = $post->user_id;
        $user = User::findOrFail($userId);
        Notification::send($user, new postApproveNotification($post->title));
        return redirect()->back()->with('success','Post is approved');
    }
    public function deletePost($id){
        $post = Posts::findOrFail($id);
        $post->delete();
        $userId = $post->user_id;
        $user = User::findOrFail($userId);
        Notification::send($user, new postDeleteNotification());
        return redirect()->back()->with('success','Post is deleted');

    }
    public function approveComment($id, Comment $comment)
    {
        //
        $value = array('reported'=>0);
        $comment = Comment::where('id',$id)->update($value);
        $comment = Comment::findOrFail($id);
        $userId = $comment->user_id;
        $user = User::findOrFail($userId);
        Notification::send($user, new commentApproveNotification($comment->body));
        return redirect()->back()->with('success','Comment is approved');
    }
    public function deleteComment($id)
    {   
        $comment = Comment::findOrFail($id);
        $postId  = $comment->posts_id;
        $post  = Posts::findOrFail($postId);
        $comment->delete();
        $post->decrement('reply_count');
        $userId = $comment->user_id;
        $user = User::findOrFail($userId);
        Notification::send($user, new commentDeleteNotification());
        return redirect()->back()->with('success','Comment is deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
