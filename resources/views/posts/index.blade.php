@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header custom-card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Posts</h2>                   
                        <div class="ml-auto">
                            @include ('layouts._message')
                            <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary addButton">Add Post</a>
                        </div>
                    </div>
                </div>
            </div>    
                @foreach ($posts as $post)
                    <div class="container">                        
                        <div class="row image-card">
                            <div class="menu-buttons">
                            @can('update',$post)
                                <a href="{{route('posts.edit',$post->id)}}"><strong class="text-muted">Edit</strong></a>
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
                            <div class= "col-md-4 offset-md-2 image-box">            
                            <img src="/images/{{$post->images}}" class="img-fluid" alt="Responsive image">
                            </div>
                            @endif
                            <div class="col-md-6 m-auto">
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
                    </div>         
                @endforeach
        </div>
        <div class="col-md-12 mt-4">
            <div class="row">
               <div class=" offset-4 m-auto">
                {{$posts->links('pagination::bootstrap-4')}}
               </div>
            </div>
        </div> 
    </div>
    <!-- <div class="row pagination-div">
   
    </div> -->
</div>
@endsection