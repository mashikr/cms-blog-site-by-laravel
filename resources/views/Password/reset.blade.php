@extends('base')

    @section('content')
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 my-4">
                        <div class="card mt-4 shadow">
                    <div class="card-header text-center">
                        <h3>Reset password</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('setpassword') }}" method="post" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password" value="{{ old('password') }}" id="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm password</label>
                                <input type="password" class="form-control form-control-sm" name="confirm_password" value="" id="confirm_password" required>
                                @error('confirm_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                            <input type="hidden" name="code" value="{{ $code ?? old('code') }}">
                            <input type="submit" name="submit" class="btn btn-primary" value="Reset">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection