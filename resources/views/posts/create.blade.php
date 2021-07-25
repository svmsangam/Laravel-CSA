@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Post</h2>
                        <div class="ml-auto">
                            <a href="{{ route('posts.index') }}" 
                            class="btn btn-outline-secondary">Back to All Posts</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @include("posts._form",['buttonText'=>"Post"])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
