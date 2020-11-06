@extends('notificationbase')

    @section('body')
    <div class="display-4 text-center mt-5 text-success">
        Succefully reset password
    </div>
    <p class="text-center lead mt-4">Now you can <a href="{{ route('login') }}">login</a></p>
    @endsection   