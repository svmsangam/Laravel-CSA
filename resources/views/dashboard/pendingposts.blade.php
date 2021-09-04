@extends('dashboard.mainpage')
@section('dashboard-content')
                <p class="text-center text-muted p-post">Pending Posts</p>
                <hr>    
                @include ('layouts._message')
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post View</th>
                        <th scope="col">Actions</th>
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
                            @include("dashboard._approveform",['buttonText'=>"Approve"])
                            </form>
                            <form action="{{route('post.delete',$post->id)}}" method="post">
                            {{method_field('DELETE')}}
                            @include("dashboard._approveform",['buttonText'=>"Delete"])
                            </form>
                        </td>
                    </tbody>
                    @endforeach 
                </table>
@endsection