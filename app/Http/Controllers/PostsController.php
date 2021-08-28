<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AddPostRequest;
use Intervention\Image\Facades\Image as Image;

class PostsController extends Controller
{
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
        $posts = Posts::latest()->where('isApproved',1)->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $post = new Posts();
        return view('posts.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request, User $user)
    {
        //
       $post = new Posts;
       if($request->hasFile('image')){
        $image= $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(600, 600)->save( public_path('/images/' . $filename ) );
        $post->images = $filename;  
       }
        $post->isApproved=1?Auth::user()->role==1:"";
       
       $post->title = $request['title'];
       $post->body = $request['body'];
       $post->user_id = auth()->user()->id;
       $post->save();            

        return redirect()->route('posts.index')
                        ->with('success','Post added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {
        //
        $post -> increment('views');
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        //
        $this->authorize('update', $post);

        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(AddPostRequest $request, Posts $post)
    {
        //
        $this->authorize('update', $post);

        if($request->hasFile('image')){
         $image= $request->file('image');
         $filename = time() . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(600, 600)->save( public_path('/images/' . $filename ) );
         $post->images = $filename;  
        }
        
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->update();            
 
         return redirect()->route('posts.index')->with('success','Post updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //
        $this->authorize('delete',$post);
        $post->delete();
        return redirect()->back()
        ->with('success','Post deleted.');
    }
}
