<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Log in</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="http://localhost/laravel_login/public/">Log in App</a>
                  
                  <ul class="navbar-nav flex-row ml-auto">
                        @if(session()->has('user_email'))
                            <li class="nav-item">
                                <a href="{{ route('user') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else 
                            <li class="nav-item mr-2">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif          
                      
                  </ul>
            </nav>

            @yield('content')

        </div>            

    </div>
</body>
</html>