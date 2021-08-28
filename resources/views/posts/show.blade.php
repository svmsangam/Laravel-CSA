@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="card">
                    <div class="card-header custom-card-header">
                        <div class="d-flex align-items-center">             
                            <div class="mr-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary back-to-post-btn">Back</a>
                            </div>   
                        </div>
                    </div>
                </div> 
            </div>            
        </div>
        <div class="row image-view">
            <div class="offset-3 col-6 offset-3 main-image">
                <img src="/images/{{$post->images}}" class="img-fluid" alt="Responsive image">
            </div>
            <div class="row post-container">
                <div class="col-md-12 text-center post-content">
                    <p class="title">{{$post->title}}<p>
                    <p class="post-desc"> {!! $post->body_html !!}</p>  
                </div>
                <div class="offset-10 col-md-2">
                    <p><span class="text-muted">Posted By:</span>&nbsp;<strong>{{$post->user->name}}</strong></p>
                    <p><strong class="text-muted">{{$post->created_date}}</strong></p> 
                </div>
            </div>      
        </div>
        @include('comments._index',[
                'comments' => $post->comments,
                'replyCount'=>$post->reply_count    
        ])
    </div>
@endsection