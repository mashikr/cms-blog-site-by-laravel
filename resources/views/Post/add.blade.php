@extends('panelbase')
    @section('title')
        <title>Blogguru | Add Post</title>
    @endsection
    
    @section('content')
      <h4 class="mt-3">Create Post:</h4>
      <hr>
      {!! Form::open(['url' => route('storepost'), 'class' => 'mb-5', 'enctype' => "multipart/form-data"]) !!}
          <div class="form-group">
              {{ Form::label('title', 'Post Title', ['class' => 'h6']) }}
              {{ Form::text('title', old('title'), ['class' => 'form-control form-control-sm', 'required']) }}
              @error('title')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="row">
              <div class="col-4">
                  <div class="form-group">
                      {{ Form::label('category_id', 'Post Category', ['class' => 'h6']) }}
                      {{ Form::select('category_id', $categories, null, ['placeholder' => 'Select a category', 'class' => 'form-control form-control-sm', 'required']) }}
                      @error('category')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>
              </div>
          </div>

          <div class="form-group">
              {{ Form::label('image', 'Post Image', ['class' => 'h6']) }} <br>
              {{ Form::file('image', ['class' => 'small']) }}
              @error('image')
                <br><small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="form-group">
              {{ Form::label('content', 'Post Content', ['class' => 'h6']) }}
              {{ Form::textarea('content', old('content'), ['class' => 'form-control form-control-sm', 'row' => '5']) }}
              @error('content')
                <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
          <script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
          <script type="application/x-javascript">

            tinymce.init({selector:'#content'});
            
          </script>

          <div class="form-group">
            {{ Form::submit('Publish Post', ['class' => 'btn btn-primary']) }}
          </div>
      {!! Form::close() !!}
        

    @endsection