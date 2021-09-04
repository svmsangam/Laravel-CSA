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
            @if($post->images>0)
            <div class="offset-md-3 col-md-6 offset-md-3 main-image">
                <img src="/images/{{$post->images}}" class="img-fluid" alt="No image available">
            </div>
            @endif
            <div class=" col-md-12 post-container">
                <div class="col-md-12 text-center post-content">
                    <p class="title">{{$post->title}}<p>
                    <p class="post-desc"> {!! $post->body_html !!}</p>  
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-end">
                    <div class="col-4 text-muted text-center">Posted By:{{$post->user->name}}</div>
                    </div>
                    <div class="row justify-content-end">
                    <div class="col-4 text-muted text-center">{{$post->created_date}}</div>
                    </div>
                </div>
            </div>      
        </div>
        @include('comments._index',[
                'comments' => $post->comments,
                'replyCount'=>$post->reply_count    
        ])
    </div>
@endsection