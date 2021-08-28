@csrf

<div class="form-group">
    <label for="post-title">Title</label>
    <input type="text" name="title" id="title" value="{{old('title',$post->title)}}"
    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{$errors->first('title')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="post-body">Body</label>
    <textarea name="body" id="body" rows="10" cols="30"
    class="form-control {{$errors->has('body')? 'is-invalid' : ''}}">
        {{old('body',$post->body)}}
    </textarea>
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
    <button type="submit" class="btn btn-outline-primary btn-lg post-btn-custom">{{$buttonText}}</button>
</div>