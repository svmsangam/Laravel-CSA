@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header custom-card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Post</h2>
                        <div class="ml-auto">
                            <a href="{{url()->previous()}}" 
                            class="btn btn-outline-secondary addButton">Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data" id="editForm">
                    {{method_field('PUT')}}
                    @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" value="{{old('title',$post->title)}}"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('title')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" rows="10" cols="30" class="form-control {{$errors->has('body')? 'is-invalid' : ''}}">{{old('body',$post->body)}}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('body')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            <input type="file" name="image" id="image" class="form-control" placeholder="image">
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('image')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg post-btn-custom">Update</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script>
    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
    },); 
        jQuery(function($){
            $('#editForm').validate({
                rules:{
                    title:{
                        required:true,
                    },
                    body:{
                        required:true,
                    },
                    image:{
                        accept: "image/jpg,image/jpeg,image/png",
                        filesize: 2,097,152,
                    },
                },
                messages:{
                    title:{
                        required:"Title is required",
                    },
                    body:{
                        required:"Body is required",
                    },
                    image:{
                        accept: "File type not supprted. Use jpg/jpeg/png/svg only",
                        filesize: "Image must be less than 2MB"
                    },

                },
            });

        });

</script>
@endsection
