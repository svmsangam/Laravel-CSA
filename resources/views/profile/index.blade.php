@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 profile-menu">
                <div class="row justify-content-between">
                    <div class="col-12"><strong class="text-muted">{{$user->name}}</strong></div>
                    <div class="col-12"><strong class="text-muted">{{$user->email}}</strong></div>
                    <div class="col-12">
                        <strong class="text-muted">
                        Total Posts:{{$user->post()->count()}}
                        </strong>
                    </div>
                </div>
        </div>     
        <div class="col-md-8 dashboard-content">
            <div class="row justify-content-center">
             @auth   
                @if(Auth::user()->id==$user->id)
                    @foreach($notifications as $notification)
                    @if($notification->type==='App\Notifications\postApproveNotification')
                        <div class="col-md-8 mb-2 m-2 notification-container">
                          <p>{{$notification->data['message']}}:&nbsp;<span class="text-muted">
                              {{$notification->data['title']}}</span> has been approved.</p>
                        </div>
                    @endif
                    @if($notification->type==='App\Notifications\commentApproveNotification')
                        <div class="col-md-8 m-2 notification-container">
                          <p> {{$notification->data['message']}}:&nbsp;<span class="text-muted">
                              {{$notification->data['body']}}</span></p>
                        </div>
                    @endif
                    @if($notification->type==='App\Notifications\commentDeleteNotification')
                        <div class="col-md-8 m-2 notification-container">
                          <p> {{$notification->data['message']}}</p>
                        </div>
                    @endif
                    @if($notification->type==='App\Notifications\commentReportNotification')
                        <div class="col-md-8 m-2 notification-container">
                        <p> {{$notification->data['message']}}:<span class="text-muted">
                              {{$notification->data['body']}}</span></p>
                        </div>
                    @endif
                    @if($notification->type==='App\Notifications\postDeleteNotification')
                        <div class="col-md-8 m-2 notification-container">
                        <p> {{$notification->data['message']}}</p>
                        </div>
                    @endif         
                    @endforeach
                @endif
             @endauth    
            </div>
            @foreach($posts as $post)
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
                    <div class= "col-md-4 image-box">            
                        <img src="/images/{{$post->images}}" class="img-fluid" alt="Responsive image">
                    </div>
                     @endif
                    <div class="col-offset-2 col-md-6 m-auto">
                        <h4 class="card-title">{{$post->title}}</h4>
                        <h5>By:&nbsp;<a href="{{$post->user->url}}">{{$post->user->name}}</a></h4>
                        <h5>Created:&nbsp;<small class="text-muted">{{$post->created_date}}</small><h5>   
                                <!-- <h5>Last updated:&nbsp;<small class="text-muted">{{$post->updated_date}}</small></h5> -->
                        <p>{{ str_limit($post->body, 250) }}</p>
                        <div class="reactions">
                            {{str_plural('view',$post->views)}} <span></span> <strong class="text-muted">{{$post->views}}</strong>
                            {{str_plural('reply',$post->reply_count)}} <span ></span> <strong class="text-muted">{{$post->reply_count}}</strong>
                        </div>
                            <a href="{{$post->url}}" class="btn btn-primary btn-custom">View Post</a>
                        </div>          
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 