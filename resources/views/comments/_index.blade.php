<div class="row commentcontainer">
    <div class="col-md-12">
        <div class="card-title">
            <h2>{{$replyCount." ". str_plural("Comment" ,$replyCount)}}</h2>
        </div>
        <hr>
        @include('layouts._message')
         @foreach ($post->comments as $comment)
            <div class="media-body d-flex">
                <div class="col-8 media">{!! $comment->body_html !!}</div>   
                @can('delete',$comment)            
                <div class="media ml-auto">
                    <form action="{{route('posts.comments.destroy',[$post->id,$comment->id])}}" 
                         method="post" class="form-delete">
                        @method('DELETE')
                        @csrf 
                        <button type="submit" class="btn btn-sm btn-outline-danger dlt-custom " 
                        onclick = "return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
                @endcan
                <div class="ml-auto">
                    <span class="text-muted">
                        {{$comment->created_date}}
                    </span>                
                    <div class="media mt-1">
                        <a href="{{$comment->user->url}}">{{$comment->user->name}}</a>
                    </div>
                </div>
            </div>
            <hr>
         @endforeach
    </div>
    <div class="col-md-12 commentbox">
            @include('comments._create') 
    </div>
</div>

