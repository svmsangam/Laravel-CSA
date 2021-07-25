<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{   
    // public function _construct()
    // {
    //     $this->middleware('auth')->except(['show','index',]);
    // }
    public function __construct()
    {
        // $this->authorizeResource(Posts::class, 'posts');
        $this->middleware('auth')->except(['show','index',]);
    }
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
    public function store(Posts $post, Request $request)
    {
        //
        $post->comments()->create($request->validate([
                'body' => 'required' 
        ])+['user_id'=>\Auth::id()]);
        $post->increment('reply_count');

        return back()->with('success',"Your comment was added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post , Comment $comment)
    {
        //

        $this->authorize('delete',$comment);
        $comment->delete();
        $post->decrement('reply_count');
        return back()->with('success',"Comment Deleted");
    }
}
