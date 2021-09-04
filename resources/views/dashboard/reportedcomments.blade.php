@extends('dashboard.mainpage')
@section('dashboard-content')
                <p class="text-center text-muted p-post">Reported Comments</p>
                <hr>    
                @include ('layouts._message')
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    @foreach($comments as $comment)
                    <tbody>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->body}}</td>
                        <td>                            
                            <form action="{{route('comment.approve',$comment->id)}}" method="post">
                            {{method_field('PUT')}}
                            @include("dashboard._approveform",['buttonText'=>"Approve"])
                            </form>
                            <form action="{{route('comment.delete',$comment->id)}}" method="post">
                            {{method_field('DELETE')}}
                            @include("dashboard._approveform",['buttonText'=>"Delete"])
                            </form>

                        </td>
                    </tbody>
                    @endforeach 
                </table>
@endsection
