@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center text-muted p-post">Pending Posts</p>
                <hr>    
                @include ('layouts._message')
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post View</th>
                        <th scope="col">Approve Post</th>
                        </tr>
                    </thead>
                    @foreach($posts as $post)
                    <tbody>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->title}}</td>
                        <td><a href="{{$post->url}}">Go to Post</a></td>
                        <td>                            
                            <form action="{{route('post.approve',$post->id)}}" method="post">
                            {{method_field('PUT')}}
                            @include("dashboard._approveform")
                            </form>
                        </td>
                    </tbody>
                    @endforeach 
                </table>
                @foreach($posts as $post)
                @endforeach
            </div>
        </div>
    </div>

@endsection