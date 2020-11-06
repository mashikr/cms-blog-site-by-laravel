@extends('base')

    @section('content')
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 my-4">
                <div class="card mt-4 shadow">
                        <div class="card-header text-center">
                        <h3>Forgot password</h3>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
                                @error('error')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                                <input type="submit" name="submit" class="btn btn-success" value="Send link">
                        </form>
                        </div>
                </div>
            </div>
        </div>
    @endsection   
