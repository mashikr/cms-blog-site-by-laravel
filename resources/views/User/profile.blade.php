@extends('panelbase')
    @section('title')
        <title>Blogguru | Profile</title>
    @endsection
    @section('content')
       <div class="row my-4">
           <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <img src="/cms-blog/public/image/{{ $user->photo->file_name }}" alt="" class="img-fluid">
                {!! Form::open(['url' => route('updateimage'), 'enctype' => "multipart/form-data"]) !!}
                    <div class="form-group">
                        {{ Form::file('image', ['class' => 'small mt-3', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Change', ['class' => 'btn btn-sm btn-primary btn-block']) }}
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                {!! Form::close() !!}
           </div>
           <div class="col-10 col-sm-8 mt-4 mt-sm-0 ml-5">
                {!! Form::open(['url' => route('updatename')]) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name</span>
                          </div>
                        {{ Form::text('name', old('name') ?? $user->name, ['class' => 'form-control', 'required']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    @error('name')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                {!! Form::close() !!}

                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                      </div>
                    {{ Form::text('name', $user->email, ['class' => 'form-control bg-white', 'disabled']) }}
                </div>

                <h4 class="mt-5">Update password</h4>
                {!! Form::open(['url' => route('updatepassword')]) !!}
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Current Password</span>
                          </div>
                        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                    </div>
                    @error('password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">New Password</span>
                          </div>
                        {{ Form::password('new_password', ['class' => 'form-control', 'required']) }}
                    </div>
                    @error('new_password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Confirm Password</span>
                          </div>
                        {{ Form::password('new_confirm_password', ['class' => 'form-control', 'required']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    @error('new_confirm_password')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                {!! Form::close() !!}
                @if(Session::has('updatepassword'))
                    <div class="alert alert-success mt-2">{{ Session::get('updatepassword') }}</div>
                @endif
           </div>
           {{-- {{ print_r(session()->all()) }} --}}
       </div>
    @endsection