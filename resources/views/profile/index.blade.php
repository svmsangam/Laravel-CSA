@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 user-details">
                <p>{{$user->email}}</p>
                <p>{{$user->name}}</p>
                <p>Total Posts:&nbsp;{{$posts->count()}}</p>
            </div>
            <div class="col-offset-2 col-8 ml-auto">
                @include('layouts._message');
                @if($posts->count()>0)
                    @foreach($posts as $post)
                    <div class="container">
                        <div class="row image-card">
                            <div class="menu-buttons">
                            @can('update',$post)
                                <a href="{{route('profilepost.edit',$post->id)}}"><strong class="text-muted">Edit</strong></a>
                            @endcan
                            @can('delete',$post)    
                                <form id="DLT" action="{{route('posts.destroy',$post->id)}}" method="post" class="form-delete">
                                    @method('DELETE')
                                    @csrf 
                                    <button type="submit" 
                                    class="btn btn-sm btn-outline-danger dlt-custom " 
                                    onclick = "return confirm('Are you sure?')">
                                    Delete
                                    </button>
                                </form>
                            @endcan    
                            </div>
                            @if($post->images>0)     
                            <div class= "col-4 image-box">            
                            <img src="/images/{{$post->images}}" class="img-fluid" alt="Responsive image">
                            </div>
                            @endif
                            <div class="col-offset-2 col-6 m-auto">
                            <h4 class="card-title">{{$post->title}}</h4>
                            <h5>By:&nbsp;<a href="{{$post->user->url}}">{{$post->user->name}}</a></h4>
                            <h5>Created:&nbsp;<small class="text-muted">{{$post->created_date}}</small><h5>   
                            <!-- <h5>Last updated:&nbsp;<small class="text-muted">{{$post->updated_date}}</small></h5> -->
                            <p>{{ str_limit($post->body, 250) }}</p>
                            <div class="reactions">
                            {{str_plural('view',$post->views)}} <span></span> <strong class="text-muted">{{$post->views}}</strong>
                            {{str_plural('reply',$post->reply_count)}} <span ></span> <strong class="text-muted">{{$post->reply_count}}</strong>
                            <span>Status:
                                @if($post->isApproved == 0)
                                    <strong class="text-muted">Pending</strong>
                                @else
                                    <strong class="text-muted">Approved</strong>
                                @endif
                            </span>
                            </div>
                            <a href="{{$post->url}}" class="btn btn-primary btn-custom">View Post</a>
                            </div>
                        </div>
                    </div>  
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection