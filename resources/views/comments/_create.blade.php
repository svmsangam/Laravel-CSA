
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Reply</h3>
                </div>
                <hr>
                <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7" name="body"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Comment</button>
                    </div>
                </form>
            </div>
        </div>
