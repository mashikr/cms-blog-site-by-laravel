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
                        <li class="nav-item mr-2">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        
                        <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                        </li>
                  </ul>
            </nav>

            <div class="display-4 text-center mt-5">Welcome {{ $user->name }}</div>


        </div>            

    </div>
</body>
</html>