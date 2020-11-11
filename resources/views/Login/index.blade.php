@extends('base')

    @section('content')
        <div class="row justify-content-center" style="height: 83vh">
            <div class="col-sm-10 col-md-8 col-lg-6 my-4">
                        
                <div class="card mt-2 shadow">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
                                @error('error')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm" name="password" value="" id="password" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        <a class="float-right" href="{{ route('resetmail') }}">Forgot password ?</a>
                        </form>
                    </div>
                </div>

                @if (session()->has('login_warning'))
                    <div class="alert alert-danger mt-3 text-center">
                        <strong>{{ session('login_warning') }}</strong>
                  </div>
                @endif

            </div>
        </div>

    @endsection   