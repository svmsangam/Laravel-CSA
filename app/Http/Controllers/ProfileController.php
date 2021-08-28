<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Http\Requests\AddPostRequest;
use App\Policies\PostsPolicy;
use Auth;
use Intervention\Image\Facades\Image as Image;

class ProfileController extends Controller
{
    //
     /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {   
        $user =  User::findOrFail($id);
        $posts = Posts::where('user_id',$id)->orderBy('id','desc')->get();
        return view('profile.index',compact('user','posts')); 
    }
    public function edit($id)
    {
        //
        $post = Posts::findOrFail($id);
        return view('profile.edit',compact('post'));
    }
    public function update(AddPostRequest $request, $id)
    {
        //
        $post = Posts::findOrFail($id);
        $user = Auth::user()->id;
        if($request->hasFile('image')){
         $image= $request->file('image');
         $filename = time() . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(600, 600)->save( public_path('/images/' . $filename ) );
         $post->images = $filename;  
        }
        
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->update();            
       return redirect()->route('user.show',$user)->with('success','Post updated');

    }
}

