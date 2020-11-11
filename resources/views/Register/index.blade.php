@extends('base')

    @section('content')
        <div class="row justify-content-center" style="height: 83vh">
            <div class="col-sm-10 col-md-8 col-lg-6 my-4">
                <div class="card mt-2 shadow">
                    <div class="card-header text-center">
                        <h3>Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="post" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" name="confirm_password" value="" id="confirm_password" required>
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </form>
                       
                        
                        

                    </div>
                </div>
            </div>
        </div>

    @endsection   